<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\PricePlan;
use App\Models\Earning;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employers = Employer::all();
        $pricePlans = PricePlan::all();

        if ($employers->isEmpty() || $pricePlans->isEmpty()) {
            return; // Exit if there is not enough data to create earnings
        }

        // Create sample earnings for each employer
        foreach ($employers as $employer) {
            foreach ($pricePlans as $pricePlan) {
                Earning::create([
                    'order_id' => Str::random(10),
                    'transaction_id' => Str::random(15),
                    'payment_provider' => ['paypal', 'razorpay', 'stripe', 'offline'][array_rand(['paypal', 'razorpay', 'stripe', 'offline'])],
                    'employer_id' => $employer->id,
                    'price_plans_id' => $pricePlan->id,
                    'amount' => rand(100, 1000),
                    'currency_symbol' => '$',
                    'usd_amount' => rand(100, 1000),
                    'payment_status' => ['paid', 'unpaid'][array_rand(['paid', 'unpaid'])],
                    'payment_type' => ['monthly', 'yearly'][array_rand(['monthly', 'yearly'])],
                ]);
            }
        }
    }
}
