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

/**
 * Controller for managing orders and plan purchases
 * Handles CRUD operations for orders and plan management
 */
class OrderController extends Controller
{
    /**
     * Set up middleware for role-based access control
     */
    public function __construct()
    {
        $this->middleware('role_or_permission:Order view', ['only' => ['order']]);
        $this->middleware('role_or_permission:Order create', ['only' => ['orderCreate']]);
    }

    /**
     * Display list of orders/transactions with search functionality
     * 
     * @param Request $request Contains search parameters
     * @return \Illuminate\View\View
     */
    public function order(Request $request)
    {
        try {
            // Get search term from request
            $searchTerm = $request->input('search');

            // Build query with optional search filters
            $transactions = Earning::with(['plan:id,label', 'employer.user'])
                ->when($searchTerm, function ($query, $searchTerm) {
                    $query->where('order_id', 'like', '%'.$searchTerm.'%')
                        ->orWhere('transaction_id', 'like', '%'.$searchTerm.'%')
                        ->orWhere('amount', 'like', '%'.$searchTerm.'%')
                        ->orWhere('currency_symbol', 'like', '%'.$searchTerm.'%')
                        ->orWhere('usd_amount', 'like', '%'.$searchTerm.'%')
                        ->orWhere('payment_status', $searchTerm)
                        ->orWhere('payment_provider', 'like', '%'.$searchTerm.'%')
                        ->orWhereHas('employer.user', function ($q) use ($searchTerm) {
                            $q->where('employer_name', 'like', '%'.$searchTerm.'%');
                        })
                        ->orWhereHas('plan', function ($q) use ($searchTerm) {
                            $q->where('label', 'like', '%'.$searchTerm.'%');
                        });
                })
                ->latest()
                ->paginate(10);

            return view('order.transactions', compact('transactions'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while fetching transactions.']);
        }
    }

    /**
     * Show order creation form
     * 
     * @return \Illuminate\View\View
     */
    public function orderCreate()
    {
        try {
            // Get all plans and employers for selection
            $plans = PricePlan::all();
            $employers = Employer::all();

            return view('order.create', compact('plans', 'employers'));
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * Store a new order and update user plan
     * 
     * @param Request $request Contains order details
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderStore(Request $request)
    {
        // Validate order data
        $request->validate([
            'employer_id' => 'required',
            'plan_id' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
        ]);

        try {
            // Get required models
            $employer = Employer::findOrFail($request->employer_id);
            $authUser = User::findOrFail($employer->user_id);
            $plan = PricePlan::findOrFail($request->plan_id);
            $transaction_id = session('transaction_id') ?? uniqid('tr_');

            // Update or create user plan
            $user_plan = UserPlan::where('employer_id', $employer->id)->first();
            if ($user_plan) {
                // Update existing plan
                $user_plan->update([
                    'price_plans_id' => $plan->id,
                    'employee_limit' => $plan->employee_limit,
                    'client_limit' => $plan->client_limit,
                    'project_limit' => $plan->project_limit,
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                // Create new plan
                $authUser->employer->userPlan()->create([
                    'price_plans_id' => $plan->id,
                    'employee_limit' => $plan->employee_limit,
                    'client_limit' => $plan->client_limit,
                    'project_limit' => $plan->project_limit,
                    'employer_id' => $authUser->employer->id,
                ]);
            }

            // Create order record
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

            // Send email notification if mail config exists
            if (checkMailConfig()) {
                $admin = $authUser;
                Mail::to($admin)->send(new NewPlanPurchaseMail($admin, $order, $plan, $authUser));
            }

            // Update employer status
            $authUser->employer->update(['status' => true]);

            return redirect()->route('order.index')->with('success', 'Order Completed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Show order edit form
     * 
     * @param int $id Order ID
     * @return \Illuminate\View\View
     */
    public function orderEdit($id)
    {
        $order = Earning::findOrFail($id);
        $plans = PricePlan::all();
        $employers = Employer::all();
        return view('order.edit', compact('order', 'plans', 'employers'));
    }

    /**
     * Update existing order and user plan
     * 
     * @param Request $request Contains updated order details
     * @param int $id Order ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderUpdate(Request $request, $id)
    {
        // Find and update order
        $order = Earning::findOrFail($id);
        $order->update($request->all());
        $order->save();
        $order->refresh();

        // Update associated user plan
        $employer = Employer::findOrFail($order->employer_id);
        $authUser = User::findOrFail($employer->user_id);
        $plan = PricePlan::findOrFail($request->price_plans_id);

        $user_plan = UserPlan::where('employer_id', $employer->id)->first();
        if ($user_plan) {
            // Update existing plan
            $user_plan->update([
                'price_plans_id' => $plan->id,
                'employee_limit' => $plan->employee_limit,
                'client_limit' => $plan->client_limit,
                'project_limit' => $plan->project_limit,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            // Create new plan
            $authUser->employer->userPlan()->create([
                'price_plans_id' => $plan->id,
                'employee_limit' => $plan->employee_limit,
                'client_limit' => $plan->client_limit,
                'project_limit' => $plan->project_limit,
                'employer_id' => $authUser->employer->id,
            ]);
        }

        // Send email notification if mail config exists
        if (checkMailConfig()) {
            $admin = $authUser;
            Mail::to($admin)->send(new NewPlanPurchaseMail($admin, $order, $plan, $authUser));
        }

        // Update employer status
        $authUser->employer->update(['status' => true]);

        return redirect()->route('order.index')->with('success', 'Order Updated.');
    }

    /**
     * Delete an order
     * 
     * @param int $id Order ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderDestroy($id)
    {
        $order = Earning::findOrFail($id);
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order Deleted.');
    }
}
