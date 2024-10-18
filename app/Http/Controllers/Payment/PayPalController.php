<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\PaymentTrait;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    use PaymentTrait;

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        // Getting payment info from session
        $price = $request->amount ?? '100';

        // Amount conversion
        // $converted_amount = currencyConversion($price);
        $converted_amount = $price;

        // Storing payment info in session
        session(['order_payment' => [
            'payment_provider' => 'paypal',
            'amount' => $converted_amount,
            'currency_symbol' => '$',
            'usd_amount' => $converted_amount,
        ]]);

        // plan info
        session(['plan' => [
            'plan_id' => $request->plan_id,

        ]]);
        if ($request->amount == 0) {
            $this->orderPlacing();
            return redirect()->route('dashboard')->with('success', 'Plan Purchase Completed.');
        }

        // PayPal payment process
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paypal.successTransaction'),
                'cancel_url' => route('paypal.cancelTransaction'),
            ],
            'purchase_units' => [
                0 => [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $converted_amount,
                    ],
                ],
            ],
        ]);

        $message = isset($response['error']['message']) ? $response['error']['message'] : __('something_went_wrong');

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            session()->flash('error', $message);

            return back();
        } else {
            session()->flash('error', $message);

            return back();
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            session(['transaction_id' => $response['id'] ?? null]);

            $this->orderPlacing(); // Process the order

            return redirect()->route('dashboard')->with('success', 'Plan Purchase Completed.');
        } else {
            session()->flash('error', __('payment_was_failed'));

            return back();
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        session()->flash('error', __('payment_was_failed'));

        return back();
    }
}
