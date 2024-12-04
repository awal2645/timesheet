<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'employee_name' => 'required|string',
            'employer_id' => 'required',
            'phone' => 'required',
            'project_id' => 'nullable|integer',
            'client_id' => 'nullable|integer',
            'employee_share' => 'nullable|numeric',
            'billing_rate' => 'nullable|numeric',
            'payment_type' => 'required',
            'gender' => 'nullable|in:male,female,other',
            'total_leave' => 'nullable|numeric',
        ];
    }
}
