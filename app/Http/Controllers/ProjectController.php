<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get search parameters
            $search = $request->input('search');
            $status = $request->input('status');

            // Check if the user is an employer and filter projects accordingly
            if (auth('web')->user()->role == 'employer') {
                $projects = Project::where('employer_id', auth('web')->user()->employer->id);
            } else {
                $projects = Project::query();
            }

            // Apply search filter if a search term is present
            if ($search) {
                $projects = $projects->where(function ($query) use ($search) {
                    $query->where('project_name', 'like', "%{$search}%")
                        ->orWhereHas('client', function ($q) use ($search) {
                            $q->where('client_name', 'like', "%{$search}%");
                        })
                        ->orWhere('billing_rate', $search);
                });
            }

            // Apply status filter if it's present
            if ($status !== null) {
                $projects = $projects->where('status', $status);
            }

            // Fetch the filtered projects
            $projects = $projects->paginate(5);

            // Return the view with the filtered projects
            return view('project.index', compact('projects'));
        } catch (\Exception $e) {
            // Handle the exception and redirect back with an error message
            return redirect()
                ->back()
                ->with(['error' => 'An error occurred while loading the projects. Please try again later.']);
        }
    }

    public function create()
    {
        try {
            $employers = Employer::all();
            $employees = Employee::all();
            $clients = Client::all();

            return view('project.create', compact('employers', 'employees', 'clients'));
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->with(['error' => 'An error occurred while creating the project. Please try again later.']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employer_id' => 'required|exists:employers,id',
            'employee_id' => 'required|exists:employees,id',
            'project_name' => 'required|string',
            'payment_type' => 'required',
            'fixed_budget' => 'sometimes',
            'hr_budget' => 'sometimes',
        ]);
        try {
            Project::create($request->all());

            return redirect()->route('project.index')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with(['error' => 'An error occurred while creating the project. Please try again later.']);
        }
    }

    public function edit($id)
    {
        try {
            $project = Project::findOrFail($id);
            $employers = Employer::all();
            $employees = Employee::all();
            $clients = Client::all();

            return view('project.edit', compact('project', 'employers', 'employees', 'clients'));
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->with(['error' => 'An error occurred while loading the project for editing. Please try again later.']);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employer_id' => 'required|exists:employers,id',
            'employee_id' => 'required|exists:employees,id',
            'project_name' => 'required|string',
            'payment_type' => 'required',
            'fixed_budget' => 'sometimes',
            'hr_budget' => 'sometimes',
        ]);
        try {
            $project = Project::findOrFail($id);
            $project->update($request->all());

            return redirect()->route('project.index')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with(['error' => 'An error occurred while updating the project. Please try again later.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();

            return redirect()->route('project.index')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->with(['error' => 'An error occurred while deleting the project. Please try again later.']);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            // Your logic to update status goes here
            $project = Project::findOrFail($id);
            // Update employee
            $project->update(['status' => $project->status == '1' ? '0' : '1']);
            // Determine color based on the updated status

            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
