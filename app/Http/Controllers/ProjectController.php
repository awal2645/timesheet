<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Project;
use Illuminate\Http\Request;

/**
 * Controller for managing projects
 * Handles CRUD operations for projects with role-based access
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of projects with search and filter functionality
     * 
     * @param Request $request Contains search and filter parameters
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            // Get search parameters
            $search = $request->input('search');
            $status = $request->input('status');
            
            // Filter projects based on user role
            if (auth('web')->user()->role == 'employer') {
                // Employers see only their projects
                $projects = Project::where('employer_id', auth('web')->user()->employer->id);
            } else if (auth('web')->user()->role == 'client') {
                // Clients see only their projects
                $projects = Project::where('client_id', auth('web')->user()->client->id);
            } else if (auth('web')->user()->role == 'employee') {
                // Employees see only their assigned projects
                $projects = Project::where('employee_id', auth('web')->user()->employee->id);
            } else {
                // Admins see all projects
                $projects = Project::query();
            }

            // Apply search filter if present
            if ($search) {
                $projects = $projects->where(function ($query) use ($search) {
                    $query->where('project_name', 'like', "%{$search}%")
                        ->orWhereHas('client', function ($q) use ($search) {
                            $q->where('client_name', 'like', "%{$search}%");
                        })
                        ->orWhere('status', $search);
                });
            }

            // Apply status filter if present
            if ($status !== null) {
                $projects = $projects->where('status', $status);
            }

            // Get paginated results
            $projects = $projects->latest()->paginate(5);

            return view('project.index', compact('projects'));
        } catch (\Exception $e) {
            // Handle the exception and redirect back with an error message
            return redirect()
                ->back()
                ->with(['error' => 'An error occurred while loading the projects. Please try again later.']);
        }
    }

    /**
     * Show form for creating a new project
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            // Get available employers, employees, and clients based on user role
            if (auth('web')->user()->role == 'employer') {
                // Employers see only their related records
                $employers = Employer::active()->get();
                $employees = Employee::where('employer_id', auth('web')->user()->employer->id)->active()->get();
                $clients = Client::where('employer_id', auth('web')->user()->employer->id)->active()->get();
            } else {
                // Admins see all records
                $employers = Employer::active()->get();
                $employees = Employee::active()->get();
                $clients = Client::active()->get();
            }

            return view('project.create', compact('employers', 'employees', 'clients'));
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->with(['error' => 'An error occurred while creating the project. Please try again later.']);
        }
    }

    /**
     * Store a newly created project
     * 
     * @param Request $request Contains project details
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate project data
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employer_id' => 'required|exists:employers,id',
            'employee_id' => 'required|exists:employees,id',
            'project_name' => 'required|string',
            'payment_type' => 'required',
            'fixed_budget' => 'sometimes',
            'hr_budget' => 'sometimes',
            'total_cost' => 'sometimes',
            'total_paid_client' => 'sometimes',
        ]);

        try {
            // Create new project
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

    /**
     * Show form for editing a project
     * 
     * @param int $id Project ID
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            // Get project and related data
            $project = Project::findOrFail($id);
            $employers = Employer::all();
            
            // Filter employees and clients based on user role
            if (auth('web')->user()->role == 'employer') {
                $employees = Employee::where('employer_id', auth('web')->user()->employer->id)->get();
                $clients = Client::where('employer_id', auth('web')->user()->employer->id)->get();
            } else {
                $employees = Employee::all();
                $clients = Client::all();
            }

            return view('project.edit', compact('project', 'employers', 'employees', 'clients'));
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->with(['error' => 'An error occurred while loading the project for editing. Please try again later.']);
        }
    }

    /**
     * Update an existing project
     * 
     * @param Request $request Contains updated project details
     * @param int $id Project ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate updated project data
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employer_id' => 'required|exists:employers,id',
            'employee_id' => 'required|exists:employees,id',
            'project_name' => 'required|string',
            'payment_type' => 'required',
            'fixed_budget' => 'sometimes',
            'hr_budget' => 'sometimes',
            'total_cost' => 'sometimes',
            'total_paid_client' => 'sometimes',
        ]);

        try {
            // Update project
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

    /**
     * Remove a project
     * 
     * @param string $id Project ID
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Update project status
     * 
     * @param Request $request Contains status update
     * @param int $id Project ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
            // Toggle project status between 1 and 0
            $project->update(['status' => $project->status == '1' ? '0' : '1']);

            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
