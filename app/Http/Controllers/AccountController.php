<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('access_limitation', ['only' => ['employeeInfoUpdate', 'employerInfoUpdate']]);
    // }

    public function myAccount()
    {
        if (auth('web')->user()->role == 'employer') {
            $employer = Employer::where('user_id', auth('web')->user()->id)->first();
            $roles = Role::all();
            $modelHasRoles = DB::table('model_has_roles')->where('model_id', $employer->user->id)->pluck('role_id');
            $role_name = $roles->find($modelHasRoles[0]);

            return view('employer.setting', compact('employer', 'modelHasRoles', 'roles', 'role_name'));
        } elseif (auth('web')->user()->role == 'employee') {
            $employee = Employee::where('user_id', auth('web')->user()->id)->first();

            return view('employee.profile', compact('employee'));
        } else {
            $client = Client::where('user_id', auth('web')->user()->id)->first();
            return view('client.profile', compact('client'));
        }
    }

    public function employerInfoUpdate(Request $request, $id)
    {
        $employer = Employer::findOrFail($id);
        $user = User::findOrFail($employer->user_id);
        $request->validate([
            'employer_name' => 'required|string|max:255',
            'fein_number' => 'required',
            'phone' => 'required|string|max:255',
            'contact_person_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|url|max:255',
            'address' => 'required|string|max:255',
            'address1' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'account_details' => 'nullable|string',
        ]);

        try {
            if ($request->hasFile('logo')) {
                $this->saveLogo($request->file('logo'), $user);
                $employer->image = 'images/employer/' . $user->username . '.png';
                $employer->save();
            }

            $employer->update($request->except('logo'));
            $user->update($request->except('logo'));

            return redirect()->back()->with('success', 'Employer info updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating employer: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Employer info updated successfully');
    }

    private function saveLogo($file, $user)
    {
        $logoPath = public_path('/images/employer/' . $user->username . '.png');

        // Delete the old logo if it exists
        if (File::exists($logoPath)) {
            File::delete($logoPath);
        }

        // Save the new logo
        $file->move(public_path('/images/employer'), $user->username . '.png');
        return true;
    }

    private function saveImage($file, $user)
    {
        $logoPath = public_path('/images/employee/' . $user->username . '.png');

        // Delete the old logo if it exists
        if (File::exists($logoPath)) {
            File::delete($logoPath);
        }

        // Save the new logo
        $file->move(public_path('/images/employee'), $user->username . '.png');
        return true;
    }


    private function saveClientImage($file, $user)
    {
        $logoPath = public_path('/images/client/' . $user->username . '.png');

        // Delete the old logo if it exists
        if (File::exists($logoPath)) {
            File::delete($logoPath);
        }

        // Save the new logo
        $file->move(public_path('/images/client'), $user->username . '.png');
        return true;
    }


    public function clientInfoUpdate(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $user = User::findOrFail($client->user_id);
        // Validate input
        $request->validate([
            'email' => "required|email|unique:users,email,$user->id",
            'client_name' => 'required|string',
            'client_phone' => 'required',
        ]);

        try {

            if ($request->hasFile('image')) {
                $this->saveClientImage($request->file('image'), $user);
                $user->image = 'images/client/' . $user->username . '.png';
                $user->save();
            }

            $user->email = $request->email;
            $user->username = $request->username;
            $user->save();

            // Update employee
            $user->client->update($request->except('image', 'email', 'username'));

            return redirect()->back()->with('success', 'Account info updated successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->back()
                ->with('error', 'An error occurred while updating employee: ' . $e->getMessage());
        }
    }

    public function employeeInfoUpdate(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);
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
                $this->saveImage($request->file('image'), $user);
                $user->image = 'images/employee/' . $user->username . '.png';
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
