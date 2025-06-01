<?php

namespace Modules\Payment\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\App\Models\PricePlan;
use Illuminate\Support\Facades\Validator;

class PricePlanController extends Controller
{
    public function index()
    {
        $plans = PricePlan::all();
        return view('payment::price_plans.index', compact('plans'));
    }

    public function create()
    {
        return view('payment::price_plans.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'features' => 'required|array',
            'features.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        PricePlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => json_encode($request->features)
        ]);

        return redirect()->route('plans.index')
            ->with('success', __('Plan created successfully.'));
    }

    public function edit(PricePlan $plan)
    {
        return view('payment::price_plans.edit', compact('plan'));
    }

    public function update(Request $request, PricePlan $plan)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'features' => 'required|array',
            'features.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => json_encode($request->features)
        ]);

        return redirect()->route('plans.index')
            ->with('success', __('Plan updated successfully.'));
    }

    public function destroy(PricePlan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')
            ->with('success', __('Plan deleted successfully.'));
    }
} 