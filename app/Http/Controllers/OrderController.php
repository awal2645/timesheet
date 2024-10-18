<?php

namespace App\Http\Controllers;

use App\Mail\NewPlanPurchaseMail;
use App\Models\Earning;
use App\Models\Employer;
use App\Models\PricePlan;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Order view', ['only' => ['order']]);
        $this->middleware('role_or_permission:Order create', ['only' => ['orderCreate']]);
    }

    public function order(Request $request)
    {
        try {
            // Get the search query from the request
            $searchTerm = $request->input('search');

            // Fetch transactions with optional search functionality
            $transactions = Earning::with(['plan:id,label', 'employer.user'])
                ->when($searchTerm, function ($query, $searchTerm) {
                    $query->where('order_id', 'like', '%'.$searchTerm.'%') // Search by order ID
                        ->orWhere('transaction_id', 'like', '%'.$searchTerm.'%') // Search by transaction ID
                        ->orWhere('amount', 'like', '%'.$searchTerm.'%') // Search by amount
                        ->orWhere('currency_symbol', 'like', '%'.$searchTerm.'%') // Search by currency symbol
                        ->orWhere('usd_amount', 'like', '%'.$searchTerm.'%') // Search by USD amount
                        ->orWhere('payment_status', $searchTerm) // Search by payment status
                        ->orWhere('payment_provider', 'like', '%'.$searchTerm.'%') // Search by payment type
                        ->orWhereHas('employer.user', function ($q) use ($searchTerm) { // Search by employer's name
                            $q->where('name', 'like', '%'.$searchTerm.'%');
                        })
                        ->orWhereHas('plan', function ($q) use ($searchTerm) { // Search by price plan label
                            $q->where('label', 'like', '%'.$searchTerm.'%');
                        });
                })
                ->latest()
                ->paginate(50);

            return view('order.transactions', compact('transactions'));
        } catch (\Exception $e) {
            // Handle the exception (log it or display a message)
            return back()->withErrors(['error' => 'An error occurred while fetching transactions.']);
        }
    }

    public function orderCreate()
    {
        try {
            $plans = PricePlan::all();
            $employers = Employer::all();

            return view('order.create', compact('plans', 'employers'));
        } catch (\Exception $e) {

            return back();
        }
    }

    public function orderStore(Request $request)
    {
        $request->validate([
            'employer_id' => 'required',
            'plan_id' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
        ]);
        try {
            $employer = Employer::findOrFail($request->employer_id);
            $authUser = User::findOrFail($employer->user_id);
            $plan = PricePlan::findOrFail($request->plan_id);
            $transaction_id = session('transaction_id') ?? uniqid('tr_');

            // Update user plan information
            $user_plan = UserPlan::where('employer_id', $employer->id)->first();

            if ($user_plan) {
                $user_plan->update([
                    'price_plans_id' => $plan->id,
                    'employee_limit' => $plan->employee_limit,
                    'client_limit' => $plan->client_limit,
                    'project_limit' => $plan->project_limit,
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                $authUser->employer->userPlan()->create([
                    'price_plans_id' => $plan->id,
                    'employee_limit' => $plan->employee_limit,
                    'client_limit' => $plan->client_limit,
                    'project_limit' => $plan->project_limit,
                    'employer_id' => $authUser->employer->id,
                ]);
            }

            // Create order for the plan
            $order = Earning::create([
                'order_id' => rand(1000, 999999999),
                'transaction_id' => $transaction_id,
                'price_plans_id' => $plan->id,
                'employer_id' => $authUser->employer->id,
                'payment_provider' => $request->payment_method,
                'amount' => $plan->amount,
                'currency_symbol' => '$',
                'usd_amount' => $plan->price,
                'payment_status' => $request->payment_status,
                'payment_type' => 'monthly',
            ]);

            //make notification to user
            if (checkMailConfig()) {
                $admin = $authUser;
                Mail::to($admin)->send(new NewPlanPurchaseMail($admin, $order, $plan, $authUser));
            }

            $authUser->employer->update([
                'status' => true,

            ]);

            return redirect()->route('order.index')->with('success', 'Order Completed.');
        } catch (\Exception $e) {

            // Optionally redirect to an error page or return back with error
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
