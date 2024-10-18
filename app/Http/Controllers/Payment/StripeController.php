<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\PaymentTrait;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeController extends Controller
{
    use PaymentTrait;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentPurchase(Request $request)
    {
        try {

            $stripe_secret = config('zenxserv.stripe_secret');
            $price = $request->amount;

            // Amount conversion
            // $converted_amount = currencyConversion($price);
            $converted_amount = $price;

            // Storing payment info in session
            session(['order_payment' => [
                'payment_provider' => 'stripe',
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

            // Stripe payment process
            Stripe::setApiKey($stripe_secret);

            // Creating product
            $product = $this->createProduct();

            // Creating price
            $price = $this->createPrice($product->id, $converted_amount);


            // Stripe checkout session
            $checkout_session = Session::create([
                'line_items' => [[
                    'price' => $price->id,
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.payment.success'),
                'cancel_url' => route('stripe.payment.cancel'),
            ]);

            return redirect($checkout_session->url);
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function paymentSuccess()
    {
        return $this->orderPlacing();
    }

    public function paymentCancel()
    {

        return redirect()->route('plans.index')->with('success', 'Payment Cancel Successfully');
    }

    protected function createProduct($name = null, $type = 'service', $active = true)
    {
        $stripe_secret = config('zenxserv.stripe_secret');
        $stripe = new StripeClient($stripe_secret);

        if (is_null($name)) {
            $name = env('APP_NAME') . ' Products';
        }

        return $stripe->products->create([
            'active' => $active,
            'name' => $name,
            'type' => $type,
        ]);
    }

    protected function createPrice($productId, $amount, $currency = 'usd')
    {
        $stripe_secret = config('zenxserv.stripe_secret');
        $stripe = new StripeClient($stripe_secret);

        return $stripe->prices->create([
            'product' => $productId,
            'unit_amount' => $amount * 100,
            'currency' => $currency,
        ]);
    }
}
