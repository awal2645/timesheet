<?php

namespace App\Http\Requests\Employee;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeRequestHandler
{
    /**
     * Validate and return the validated employee data.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function validateSaveRequest(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $request->validate([
            'email' => "required|email|unique:users,email,{$user->id}",
            'employee_name' => 'required|string',
            'employer_id' => 'required|integer',
            'phone' => 'required|string',
            'client_id' => 'nullable|integer',
            'gender' => 'nullable|in:male,female,other',
            'employee_share' => 'nullable|numeric',
            'billing_rate' => 'nullable|numeric',
            'monthly_salary' => 'nullable|numeric',
            'payment_type' => 'required|string',
        ]);

        return [
            'email' => $request->email,
            'employee_name' => $request->employee_name,
            'employer_id' => $request->employer_id,
            'phone' => $request->phone,
            'client_id' => $request->client_id,
            'gender' => $request->gender,
            'employee_share' => $request->employee_share,
            'billing_rate' => $request->billing_rate,
            'monthly_salary' => $request->monthly_salary,
            'payment_type' => $request->payment_type,
        ];
    }
}
