<?php

namespace App\Http\Controllers;

use App\Models\PricePlan;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Plan view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Plan create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Plan update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Plan destroy', ['only' => ['destroy']]);
    }

    public function index()
{
    // Check if the user is authenticated
    if (auth()->check()) {
        // Fetch price plans based on the user's role
        if (auth()->user()->role === 'employer') {
            $pricePlans = PricePlan::where('frontend_show', true)->get();
            
            // Retrieve the user plan based on the user's ID
            $user_plan = UserPlan::where('employer_id', auth()->user()->employer->id)->first(); // Use 'where' instead of 'findOrFail'
            
            return view('price_plans.index', compact('pricePlans', 'user_plan'));
        } else {
            $pricePlans = PricePlan::all();
            return view('price_plans.index', compact('pricePlans'));
        }
    }

    // Handle cases where the user is not authenticated
    return redirect()->route('login'); // Redirect to login if not authenticated
}


    public function create()
    {
        return view('price_plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|unique:price_plans,label',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'employee_limit' => 'required|integer|min:0',
            'client_limit' => 'required|integer|min:0',
            'project_limit' => 'required|integer|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0',
        ]);

        // Handle checkboxes, default to 0 if not checked
        $recommended = $request->has('recommended') ? 1 : 0;
        $frontend_show = $request->has('frontend_show') ? 1 : 0;
        DB::table('price_plans')->update(['recommended' => false]);

        PricePlan::create([
            'label' => $request->label,
            'description' => $request->description,
            'price' => $request->price,
            'employee_limit' => $request->employee_limit,
            'client_limit' => $request->client_limit,
            'project_limit' => $request->project_limit,
            'recommended' => $recommended,
            'frontend_show' => $frontend_show,
            'old_price' => $request->old_price,
            'discount_percentage' => $request->discount_percentage,
        ]);

        return redirect()->route('plans.index')->with('success', 'Plan created successfully');
    }

    public function edit($id)
    {
        $plan = PricePlan::findOrFail($id);

        return view('price_plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $plan = PricePlan::findOrFail($id);

        $request->validate([
            'label' => 'required|unique:price_plans,label,' . $plan->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'employee_limit' => 'required|integer|min:0',
            'client_limit' => 'required|integer|min:0',
            'project_limit' => 'required|integer|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0',
        ]);

        // Handle checkboxes, default to 0 if not checked
        $recommended = $request->has('recommended') ? 1 : 0;
        $frontend_show = $request->has('frontend_show') ? 1 : 0;
        DB::table('price_plans')->update(['recommended' => false]);

        $plan->update([
            'label' => $request->label,
            'description' => $request->description,
            'price' => $request->price,
            'employee_limit' => $request->employee_limit,
            'client_limit' => $request->client_limit,
            'project_limit' => $request->project_limit,
            'recommended' => $recommended,
            'frontend_show' => $frontend_show,
            'old_price' => $request->old_price,
            'discount_percentage' => $request->discount_percentage,
        ]);

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully');
    }

    public function destroy($id)
    {
        $plan = PricePlan::findOrFail($id);
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully');
    }

    public function markRecommended()
    {

        DB::table('price_plans')->update(['recommended' => false]);
        PricePlan::findOrFail(request('plan_id'))->update(['recommended' => true]);

        return back()->with('success', 'Plan deleted successfully');
    }
}
