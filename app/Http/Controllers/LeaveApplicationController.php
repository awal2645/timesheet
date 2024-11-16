<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use Illuminate\Http\Request;
use App\Mail\LeaveApplicationMail; // Import the Mailable class
use Illuminate\Support\Facades\Mail; // Import the Mail facade

class LeaveApplicationController extends Controller
{
    public function create()
    {
        return view('leave.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        // Create the leave application
        $leaveApplication = LeaveApplication::create([
            'employee_id' => auth()->user()->employee->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
        ]);

        // Send email notification for leave application submission
        Mail::to(auth()->user()->employee->employer->user->email)->send(new LeaveApplicationMail(
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
        $applications = $query->paginate(10);

        return view('leave.index', compact('applications'));
    }
} 