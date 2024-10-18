<?php

namespace App\Traits;

use App\Mail\NewPlanPurchaseMail;
use App\Models\Earning;
use App\Models\PricePlan;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait PaymentTrait
{
    public function orderPlacing()
    {
        try {
            $authUser = Auth::user();
            $plan = session('plan');
            $plan = PricePlan::findOrFail($plan['plan_id']);
            $order_amount = session('order_payment');
            $transaction_id = session('transaction_id') ?? uniqid('tr_');

            // Update user plan information
            $user_plan = UserPlan::where('employer_id', $authUser->employer->id)->first();

            if ($user_plan) {
                $user_plan->update([
                    'price_plans_id' => $plan->id,
                    'employee_limit' => $plan->employee_limit,
                    'client_limit' => $plan->client_limit,
                    'project_limit' => $plan->project_limit,
                    'updated_at' => Carbon::now(),
                    'free_plan' => $plan->label == 'Free Plan' ? true : false,

                ]);
            } else {
                $authUser->employer->userPlan()->create([
                    'price_plans_id' => $plan->id,
                    'employee_limit' => $plan->employee_limit,
                    'client_limit' => $plan->client_limit,
                    'project_limit' => $plan->project_limit,
                    'employer_id' => $authUser->employer->id,
                    'free_plan' => $plan->label == 'Free Plan' ? true : false,
                ]);
            }

            // Create order for the plan
            $order = Earning::create([
                'order_id' => rand(1000, 999999999),
                'transaction_id' => $transaction_id,
                'price_plans_id' => $plan->id,
                'employer_id' => $authUser->employer->id,
                'payment_provider' => $order_amount['payment_provider'],
                'amount' => $order_amount['amount'],
                'currency_symbol' => $order_amount['currency_symbol'],
                'usd_amount' => $order_amount['usd_amount'],
                'payment_status' => 'paid',
                'payment_type' => 'monthly',
            ]);

            // Forget sessions and store plan information

            $authUser->employer->update([
                'status' => true,

            ]);
            // make notification to admins
            if (checkMailConfig()) {
                $admin = User::find(1);
                Mail::to($admin)->send(new NewPlanPurchaseMail($admin, $order, $plan, $authUser));
            }

            return redirect()->route('dashboard')->with('success', 'Plan Purchase Completed.');
        } catch (\Exception $e) {

            // Optionally redirect to an error page or return back with error
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
