<?php

namespace App\Http\Controllers;

use App\Mail\EmployeeInviteMail;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Employee view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Employee create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Employee update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Employee destroy', ['only' => ['destroy']]);
        $this->middleware('access_limitation', ['only' => ['destroy']]);
    }

    // Index page
    public function index(Request $request)
    {
        $query = Employee::query();

        // Check user role and filter by employer if necessary
        if (auth('web')->user()->role == 'employer') {
            $query->where('employer_id', auth('web')->user()->employer->id);
        }

        // Add search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('employee_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $searchTerm . '%');
        }

        // Paginate results
        $employees = $query->latest()->paginate(10);
        $employers = Employer::latest()->paginate(10);

        return view('employee.index', compact('employees', 'employers'));
    }

    // Create form
    public function create()
    {
        $employers = Employer::all();
        $clients = Client::all();

        return view('employee.create', compact('employers', 'clients'));
    }

    // Store the new employee
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
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
        ]);

        try {
            // Create new user
            $input['role'] = 'employee';
            $input['email'] = $request->email;
            $user = User::create($input);
            $user->assignRole(['employee']);

            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            if ($input['email']) {
                // Retrieve the email template from the database
                $emailTemplate = DB::table('email_templates')
                    ->where('type', 'employee_invite')
                    ->first();

                if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                    // Replace placeholders with dynamic content
                    $formattedBody = getFormattedTextByType('employee_invite', [
                        'app_name' => config('app.name'),
                        'verify_link' => route('email.verify', $token),
                        'year' => date('Y'),
                    ]);

                    // Send email using Mailable class
                    Mail::to($input['email'])->send(new EmployeeInviteMail($emailTemplate->subject, $formattedBody));
                } else {
                    return redirect()->back()->with('error', 'Email template not found or is missing required fields.');
                }
            }

            $success['token'] = $user->createToken('timesheet')->plainTextToken;
            $success['name'] = $user->name;

            // Create new employee with additional fields from the request
            $employee = Employee::create([
                'user_id' => $user->id,
                'employer_id' => $request->input('employer_id'),
                'employee_name' => $request->input('employee_name'),
                'phone' => $request->input('phone'),
                'client_id' => $request->input('client_id'),
                'gender' => $request->input('gender'),
                'employee_share' => $request->input('employee_share'),
                'billing_rate' => $request->input('billing_rate'),

            ]);

            return redirect()->route('employee.index')->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with(['error' => 'An error occurred while processing your request. Please try again later.']);
        }
    }

    // Edit form
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employers = Employer::all();
        $clients = Client::all();

        return view('employee.edit', compact('employee', 'employers', 'clients'));
    }

    // Update the employee
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);

        // Validate input
        $request->validate([
            'email' => "required|email|unique:users,email,$user->id",
            'employee_name' => 'required|string',
            'employer_id' => 'required',
            'phone' => 'required',
            'client_id' => 'nullable|integer',
            'gender' => 'nullable|in:male,female,other',
            'employee_share' => 'nullable|numeric',
            'billing_rate' => 'nullable|numeric',
            'monthly_salary' => 'nullable|numeric',
            'payment_type' => 'required',
        ]);
        try {

            if ($request->hasFile('image')) {
                $user = User::findOrFail(auth('web')->user()->id);
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('user'), $imageName);
                $user->image = 'user/' . $imageName;
                $user->save();
            }
            $user->email = $request->email;
            $user->save();
            // Update employee
            $employee->update($request->except('image', 'email'));

            return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->back()
                ->with('error', 'An error occurred while updating employee: ' . $e->getMessage());
        }
    }

    // Delete the employee
    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $user = User::findOrFail($employee->user_id);
            $user->delete();
            $employee->delete();

            return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()->route('employee.index')->with('error', 'An error occurred while deleting employee: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            // Your logic to update status goes here
            $employee = Employee::findOrFail($id);

            // Update employee
            $employee->update(['status' => $request->status]);
            // Determine color based on the updated status

            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function employerClient($employer)
    {
        try {
            $employer = Employer::where('employer_name', $employer)->value('id');
            $employees = Employee::where('employer_id', $employer)->paginate(10);

            $employers = Employer::all();

            return view('employee.index', compact('employees', 'employers'));
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->route('home')
                ->with('error', 'An error occurred while fetching clients: ' . $e->getMessage());
        }
    }
}
