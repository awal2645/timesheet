<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use App\Mail\LeaveApplicationMail; // Import the Mailable class

class LeaveApplicationController extends Controller
{
    public function create()
    {
        $leaveTypes = LeaveType::all();
        if (Auth::user()->is_employee) {
            return view('leave.create', compact('leaveTypes'));
        }elseif (Auth::user()->is_employer) {

            $employees = Employee::where('employer_id', Auth::user()->employer->id)->get();
            return view('leave.create', compact('leaveTypes', 'employees'));
        }else {
            $employees = Employee::all();
            $employers = Employer::all();
            return view('leave.create', compact('leaveTypes', 'employees', 'employers'));        
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if (auth()->user()->role != 'employee') {
            $employeeId = $request->employee_id;
        } else {
            $employeeId = auth()->user()->employee->id;
        }
        // Create the leave application
        $leaveApplication = LeaveApplication::create([
            'employee_id' => $employeeId,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
        ]);

        $employer = Employee::find($employeeId)->employer;
        // Send email notification for leave application submission
        Mail::to($employer->user->email)->send(new LeaveApplicationMail(
            auth()->user(),
            $leaveApplication->start_date,
            $leaveApplication->end_date,
            $leaveApplication->reason,
            'submitted' // Action type
        ));

        return redirect()->route('leave.index')->with('success', 'Leave application submitted successfully.');
    }

    public function approve($id)
    {
        $application = LeaveApplication::findOrFail($id);
        $application->update(['status' => 'approved']);

        // Send email notification for leave application approval
        Mail::to($application->employee->user->email)->send(new LeaveApplicationMail(
            $application->employee->user,
            $application->start_date,
            $application->end_date,
            $application->reason,
            'approved' // Action type
        ));

        return redirect()->back()->with('success', 'Leave application approved.');
    }

    public function deny($id)
    {
        $application = LeaveApplication::findOrFail($id);
        $application->update(['status' => 'denied']);

        // Send email notification for leave application denial
        Mail::to($application->employee->user->email)->send(new LeaveApplicationMail(
            $application->employee->user,
            $application->start_date,
            $application->end_date,
            $application->reason,
            'denied' // Action type
        ));

        return redirect()->back()->with('success', 'Leave application denied.');
    }

    public function index(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Initialize the query
        $query = LeaveApplication::query();

        // Check the role of the user and fetch leave applications accordingly
        if ($user->role === 'employee') {
            // Employee: Get only their own leave applications
            $query->where('employee_id', $user->employee->id);
        } elseif ($user->role === 'employer') {
            // Employer: Get leave applications for employees under this employer
            $query->whereHas('employee', function ($query) use ($user) {
                $query->where('employer_id', $user->employer->id);
            });
        }

        // Handle search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->whereHas('employee', function ($query) use ($search) {
                    $query->where('employee_name', 'like', "%{$search}%");
                })
                ->orWhere('start_date', 'like', "%{$search}%")
                ->orWhere('end_date', 'like', "%{$search}%")
                ->orWhere('reason', 'like', "%{$search}%");
            });
        }

        // Get the paginated results
        $applications = $query->latest()->paginate(10);

        return view('leave.index', compact('applications'));
    }

    public function getEmployees($employerId)
    {
        $employees = Employee::where('employer_id', $employerId)->get(['id', 'employee_name']);
        return response()->json($employees);
    }
} 