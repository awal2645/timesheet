<?php

namespace Modules\Payment\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payment\App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Modules\Payment\App\Models\PricePlan;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function process(Request $request, $planId)
    {
        try {
            $plan = PricePlan::findOrFail($planId);
            
            // Get the payment gateway from config
            $gateway = config('payment.default_gateway', 'stripe');
            
            // Route to the appropriate payment gateway
            if ($gateway === 'stripe') {
                return $this->processStripePayment($plan);
            } elseif ($gateway === 'paypal') {
                return $this->processPayPalPayment($plan);
            }
            
            throw new \Exception('Invalid payment gateway configured');
            
        } catch (\Exception $e) {
            Log::error('Payment processing error: ' . $e->getMessage());
            return redirect()->back()->with('error', __('Payment processing failed. Please try again.'));
        }
    }

    protected function processStripePayment($plan)
    {
        try {
            // Initialize Stripe
            $stripe = new \Stripe\StripeClient(config('payment.stripe.secret_key'));
            
            // Create a checkout session
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $plan->name,
                        ],
                        'unit_amount' => $plan->price * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ]);

            return redirect($session->url);
            
        } catch (\Exception $e) {
            Log::error('Stripe payment error: ' . $e->getMessage());
            return redirect()->back()->with('error', __('Stripe payment processing failed. Please try again.'));
        }
    }

    protected function processPayPalPayment($plan)
    {
        try {
            // Initialize PayPal
            $paypal = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    config('payment.paypal.client_id'),
                    config('payment.paypal.secret')
                )
            );

            $paypal->setConfig([
                'mode' => config('payment.paypal.mode', 'sandbox'),
                'log.LogEnabled' => true,
                'log.FileName' => storage_path('logs/paypal.log'),
                'log.LogLevel' => 'INFO'
            ]);

            // Create payment
            $payment = new \PayPal\Api\Payment();
            $payment->setIntent('sale')
                ->setPayer(new \PayPal\Api\Payer(['payment_method' => 'paypal']))
                ->setTransactions([[
                    'amount' => [
                        'total' => $plan->price,
                        'currency' => 'USD'
                    ],
                    'description' => $plan->name
                ]])
                ->setRedirectUrls(new \PayPal\Api\RedirectUrls([
                    'return_url' => route('payment.success'),
                    'cancel_url' => route('payment.cancel')
                ]));

            $payment->create($paypal);

            return redirect($payment->getApprovalLink());
            
        } catch (\Exception $e) {
            Log::error('PayPal payment error: ' . $e->getMessage());
            return redirect()->back()->with('error', __('PayPal payment processing failed. Please try again.'));
        }
    }

    public function success()
    {
        // Handle successful payment
        return view('payment::success');
    }

    public function cancel()
    {
        // Handle cancelled payment
        return view('payment::cancel');
    }

    /**
     * Display payment gateway settings
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('payment::payment.index');
    }

    /**
     * Update payment gateway settings
     * 
     * @param Request $request Contains payment settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try {
            // Update settings based on payment type
            switch ($request->type) {
                case 'paypal':
                    $this->paypalUpdate($request);
                    break;
                case 'stripe':
                    $this->stripeUpdate($request);
                    break;
            }
            
            return redirect()
                ->route('payment.index')
                ->with('success', 'Payment info updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update PayPal settings
     * 
     * @param Request $request Contains PayPal settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paypalUpdate(Request $request)
    {
        // Validate PayPal credentials
        $request->validate([
            'paypal_client_id' => 'required',
            'paypal_client_secret' => 'required',
        ]);

        try {
            // Update PayPal configuration based on mode
            if ($request->paypal_live_mode) {
                checkSetConfig('zenxserv.paypal_live_client_id', $request->paypal_client_id);
                checkSetConfig('zenxserv.paypal_live_secret', $request->paypal_client_secret);
            } else {
                checkSetConfig('zenxserv.paypal_sandbox_client_id', $request->paypal_client_id);
                checkSetConfig('zenxserv.paypal_sandbox_secret', $request->paypal_client_secret);
            }

            // Set PayPal mode and active status
            setConfig('zenxserv.paypal_mode', $request->paypal_live_mode ? 'live' : 'sandbox');
            checkSetConfig('zenxserv.paypal_active', $request->paypal ? true : false);

            return redirect()
                ->route('payment.index')
                ->with('success', 'Payment info updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update Stripe settings
     * 
     * @param Request $request Contains Stripe settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stripeUpdate(Request $request)
    {
        // Validate Stripe credentials
        $request->validate([
            'stripe_key' => 'required',
            'stripe_secret' => 'required',
        ]);

        try {
            // Update Stripe configuration
            checkSetConfig('zenxserv.stripe_key', $request->stripe_key);
            checkSetConfig('zenxserv.stripe_secret', $request->stripe_secret);
            checkSetConfig('zenxserv.stripe_active', $request->stripe ? true : false);

            return redirect()
                ->route('payment.index')
                ->with('success', 'Payment info updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }
} 