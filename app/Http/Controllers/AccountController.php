<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('access_limitation', ['only' => ['employeeInfoUpdate']]);
    }

    public function myAccount()
    {
        if (auth('web')->user()->role == 'employer') {
            $employee = Employer::where('user_id', auth('web')->user()->id)->first();
            $roles = Role::all();
            $modelHasRoles = DB::table('model_has_roles')->where('model_id', $employee->user->id)->pluck('role_id');
            $role_name = $roles->find($modelHasRoles[0]);

            return view('employer.edit', compact('employee', 'modelHasRoles', 'roles', 'role_name'));
        } elseif (auth('web')->user()->role == 'employee') {
            $employee = Employee::where('user_id', auth('web')->user()->id)->first();

            return view('employee.profile', compact('employee'));
        } else {
        }
    }

    public function employeeInfoUpdate(Request $request)
    {
        $user = User::findOrFail(auth('web')->user()->id);
        // Validate input
        $request->validate([
            'email' => "required|email|unique:users,email,$user->id",
            'employee_name' => 'required|string',
            'phone' => 'required',
            'client_id' => 'nullable|integer',
            'gender' => 'nullable|in:male,female,other',
        ]);

        try {

            if ($request->hasFile('image')) {
                $user = $user;
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('user'), $imageName);
                $user->image = 'user/' . $imageName;
                $user->save();
            }

            $user->email = $request->email;
            $user->save();

            // Update employee
            $user->employee->update($request->except('image', 'email', 'employer_id', 'payment_type', 'employee_share', 'billing_rate', 'monthly_salary'));

            return redirect()->back()->with('success', 'Account info updated successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->back()
                ->with('error', 'An error occurred while updating employee: ' . $e->getMessage());
        }
    }
}
