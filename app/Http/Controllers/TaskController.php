<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\Notificattion;

/**
 * Controller for managing tasks
 * Handles CRUD operations for tasks with role-based access
 */
class TaskController extends Controller
{
    /**
     * Display a listing of tasks with search functionality
     * Filters tasks based on user role
     * 
     * @param Request $request Contains search parameters
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Filter tasks based on user role
        if(auth()->user()->role == 'employee'){
            // Employees see only their assigned tasks
            $tasks = Task::where('employee_id', auth()->user()->employee->id)
                        ->latest()
                        ->paginate(10);
        } elseif(auth()->user()->role == 'employer'){
            // Employers see tasks for their company
            $tasks = Task::whereHas('employer', function ($query) {
                $query->where('employer_id', auth()->user()->employer->id);
            })->latest()->paginate(10);
        } else if (auth()->user()->role == 'client') {
            // Clients see tasks for their projects
            $tasks = Task::whereHas('project', function ($query) {
                $query->where('client_id', auth()->user()->client->id);
            })->latest()->paginate(10);
        } else {
            // Admins see all tasks
            $tasks = Task::latest()->paginate(10);
        }
        
        // Apply search filter if present
        $search = $request->input('search');
        if($search){
            $tasks = $tasks->where('task_name', 'like', '%'.$search.'%')
                          ->orWhere('', 'like', '%'.$search.'%');
        }

        // Get projects for task creation
        $projects = Project::orderBy('project_name', 'desc')->get();
        
        return view('task.index', compact('tasks', 'projects'));
    }

    /**
     * Show form for creating a new task
     * Filters available projects and employees based on user role
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get available data based on user role
        if (auth('web')->user()->role == 'employer') {
            // Employer creating task
            $employers = Employer::where('id', auth('web')->user()->employer->id)
                                ->active()
                                ->get();
            $employees = Employee::where('employer_id', auth('web')->user()->employer->id)
                                ->active()
                                ->get();
            $projects = Project::where('employer_id', auth('web')->user()->employer->id)
                              ->active()
                              ->get();
        } elseif(auth('web')->user()->role == 'employee') {
            // Employee creating task
            $employers = Employer::where('id', auth('web')->user()->employee->employer_id)
                                ->active()
                                ->get();
            $employees = Employee::where('id', auth('web')->user()->employee->id)
                                ->active()
                                ->get();
            $projects = Project::where('employer_id', auth('web')->user()->employee->employer_id)
                              ->active()
                              ->get();
        } else if (auth('web')->user()->role == 'client') {
            // Client creating task
            $employers = Employer::where('id', auth('web')->user()->client->employer_id)
                                ->get();
            $employees = Employee::where('id', auth('web')->user()->client->employer_id)
                                ->active()
                                ->get();
            $projects = Project::where('client_id', auth('web')->user()->client->id)
                              ->active()
                              ->get();
        } else {
            // Admin creating task
            $employers = Employer::active()->get();
            $employees = Employee::active()->get();
            $projects = Project::active()->get();
        }
        
        return view('task.create', compact('projects', 'employers', 'employees'));
    }

    /**
     * Store a newly created task
     * Validates input based on user role
     * 
     * @param Request $request Contains task details
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate task data based on user role
        if(auth('web')->user()->role == 'employer'){
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|string|max:255',
            ]);
        } elseif(auth('web')->user()->role == 'employee'){
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|string|max:255',
            ]);
        } else {
            $request->validate([
                'employer_id' => 'required|exists:employers,id',
                'employee_id' => 'required|exists:employees,id',
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|string|max:255',
            ]);
        }

        // Create new task
        Task::create([
            'employer_id' => $request->employer_id ?? auth('web')->user()->employer->id,
            'employee_id' => $request->employee_id ?? auth('web')->user()->employee->id,
            'project_id' => $request->project_id,
            'task_name' => $request->task_name,
            'time' => $request->time,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        // Create notification for task creation
        Notificattion::create([
            'message' => auth('web')->user()->username.' Task created',
            'from' => auth('web')->user()->id,
            'to' => $request->employee_id ?? auth('web')->user()->employee->id,
            'page_url' => '/task',
        ]);

        return redirect()->route('task.index')->with('success', 'Task created successfully!');
    }

    /**
     * Show form for editing a task
     * Filters available data based on user role
     * 
     * @param int $id Task ID
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        // Get available data based on user role
        if(auth('web')->user()->role == 'employer'){
            $employers = Employer::where('id', auth('web')->user()->employer->id)->get();
            $employees = Employee::where('employer_id', auth('web')->user()->employer->id)->get();
            $projects = Project::where('employer_id', auth('web')->user()->employer->id)->get();
        } elseif(auth('web')->user()->role == 'employee'){
            $employers = Employer::where('id', auth('web')->user()->employee->employer_id)->get();
            $employees = Employee::where('id', auth('web')->user()->employee->id)->get();
            $projects = Project::where('employer_id', auth('web')->user()->employee->employer_id)->get();
        } else if (auth('web')->user()->role == 'client') {
            $employers = Employer::where('id', auth('web')->user()->client->employer_id)->get();
            $employees = Employee::where('id', auth('web')->user()->client->employer_id)->get();
            $projects = Project::where('client_id', auth('web')->user()->client->id)->get();
        } else {
            $employers = Employer::all();
            $employees = Employee::all();
            $projects = Project::all();
        }

        return view('task.edit', compact('task', 'employers', 'employees', 'projects'));
    }

    /**
     * Update an existing task
     * Validates input based on user role
     * 
     * @param Request $request Contains updated task details
     * @param int $id Task ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate task data based on user role
        if(auth('web')->user()->role == 'employer'){
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|string|max:255',
            ]);
        } elseif(auth('web')->user()->role == 'employee'){
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|string|max:255',
            ]);
        } else {
            $request->validate([
                'employer_id' => 'required|exists:employers,id',
                'employee_id' => 'required|exists:employees,id',
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|string|max:255',
            ]);
        }

        // Update task
        $task = Task::findOrFail($id);
        $task->update([
            'employer_id' => $request->employer_id ?? auth('web')->user()->employer->id,
            'employee_id' => $request->employee_id ?? auth('web')->user()->employee->id,
            'project_id' => $request->project_id,
            'task_name' => $request->task_name,
            'time' => $request->time,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('task.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Update task time
     * 
     * @param Request $request Contains time update
     * @param int $id Task ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTime(Request $request, $id)
    {
        $task = Task::find($id);
        $task->time = $request->input('time');
        $task->save();
    
        return response()->json(['success' => true]);
    }

    /**
     * Update task status
     * 
     * @param Request $request Contains status update
     * @param int $id Task ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status = $request->input('status');
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task status updated successfully!');
    }

    /**
     * Remove a task
     * 
     * @param int $id Task ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task deleted successfully!');
    }
}
