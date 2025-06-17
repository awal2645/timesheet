<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Client;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\TaskAttachment;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use App\Models\Notificattion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $query = Task::query();

        // Filter tasks based on user role
        if(auth()->user()->role == 'employee'){
            $query->where('employee_id', auth()->user()->employee->id);
        } elseif(auth()->user()->role == 'employer'){
            $query->whereHas('employer', function ($query) {
                $query->where('employer_id', auth()->user()->employer->id);
            });
        } else if (auth()->user()->role == 'client') {
            $query->whereHas('project', function ($query) {
                $query->where('client_id', auth()->user()->client->id);
            });
        }

        // Apply search filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('task_name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('project.client', function($q) use ($search) {
                      $q->where('client_name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('employer', function($q) use ($search) {
                      $q->where('employer_name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('employee', function($q) use ($search) {
                      $q->where('employee_name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by task type
        if ($request->filled('task_type')) {
            $query->where('task_type', $request->task_type);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $query->whereHas('project', function($q) use ($request) {
                $q->where('client_id', $request->client_id);
            });
        }

        // Filter by employer
        if ($request->filled('employer_id')) {
            $query->where('employer_id', $request->employer_id);
        }

        // Filter by employee
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->where('due_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('due_date', '<=', $request->end_date);
        }

        // Get filtered tasks with pagination and preserve query parameters
        $tasks = $query->latest()->paginate(10);
        $tasks->appends($request->all());

        // Get projects for task creation
        $projects = Project::orderBy('project_name', 'desc')->get();
        
        return view('task.index', compact('tasks', 'projects'));
    }

    /**
     * Show detailed view of a specific task
     * 
     * @param int $id Task ID
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::with(['attachments', 'comments.user', 'project.client', 'employer', 'employee'])
                   ->findOrFail($id);
        
        return view('task.show', compact('task'));
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
                'description' => 'nullable|string',
                'task_type' => 'required|in:task,story,bug,epic',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|date',
                'estimated_hours' => 'nullable|numeric|min:0',
                'labels' => 'nullable|array',
                'attachments.*' => 'nullable|file|max:10240', // 10MB max per file
            ]);
        } elseif(auth('web')->user()->role == 'employee'){
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'task_type' => 'required|in:task,story,bug,epic',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|date',
                'estimated_hours' => 'nullable|numeric|min:0',
                'labels' => 'nullable|array',
                'attachments.*' => 'nullable|file|max:10240',
            ]);
        } else {
            $request->validate([
                'employer_id' => 'required|exists:employers,id',
                'employee_id' => 'required|exists:employees,id',
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'task_type' => 'required|in:task,story,bug,epic',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|date',
                'estimated_hours' => 'nullable|numeric|min:0',
                'labels' => 'nullable|array',
                'attachments.*' => 'nullable|file|max:10240',
            ]);
        }

        // Create new task
        $task = Task::create([
            'employer_id' => $request->employer_id ?? auth('web')->user()->employer->id,
            'employee_id' => $request->employee_id ?? auth('web')->user()->employee->id,
            'project_id' => $request->project_id,
            'task_name' => $request->task_name,
            'description' => $request->description,
            'task_type' => $request->task_type,
            'priority' => $request->priority,
            'time' => $request->time,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'estimated_hours' => $request->estimated_hours,
            'labels' => $request->labels,
        ]);

        // Handle file attachments
        if ($request->hasFile('attachments')) {
            $this->handleFileUploads($request->file('attachments'), $task);
        }

        // Create notification for task creation
        Notificattion::create([
            'message' => auth('web')->user()->username.' Task created',
            'from' => auth('web')->user()->id,
            'to' => $request->employee_id ?? auth('web')->user()->employee->id,
            'page_url' => '/task',
        ]);

        return redirect()->route('task.show', $task->id)->with('success', 'Task created successfully!');
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
        $task = Task::with(['attachments'])->findOrFail($id);
        
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
                'description' => 'nullable|string',
                'task_type' => 'required|in:task,story,bug,epic',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|date',
                'estimated_hours' => 'nullable|numeric|min:0',
                'labels' => 'nullable|array',
                'attachments.*' => 'nullable|file|max:10240',
            ]);
        } elseif(auth('web')->user()->role == 'employee'){
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'task_type' => 'required|in:task,story,bug,epic',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|date',
                'estimated_hours' => 'nullable|numeric|min:0',
                'labels' => 'nullable|array',
                'attachments.*' => 'nullable|file|max:10240',
            ]);
        } else {
            $request->validate([
                'employer_id' => 'required|exists:employers,id',
                'employee_id' => 'required|exists:employees,id',
                'project_id' => 'required|exists:projects,id',
                'task_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'task_type' => 'required|in:task,story,bug,epic',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:pending,inprogress,completed',
                'due_date' => 'required|date',
                'estimated_hours' => 'nullable|numeric|min:0',
                'labels' => 'nullable|array',
                'attachments.*' => 'nullable|file|max:10240',
            ]);
        }

        // Update task
        $task = Task::findOrFail($id);
        $task->update([
            'employer_id' => $request->employer_id ?? auth('web')->user()->employer->id,
            'employee_id' => $request->employee_id ?? auth('web')->user()->employee->id,
            'project_id' => $request->project_id,
            'task_name' => $request->task_name,
            'description' => $request->description,
            'task_type' => $request->task_type,
            'priority' => $request->priority,
            'time' => $request->time,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'estimated_hours' => $request->estimated_hours,
            'labels' => $request->labels,
        ]);

        // Handle new file attachments
        if ($request->hasFile('attachments')) {
            $this->handleFileUploads($request->file('attachments'), $task);
        }

        return redirect()->route('task.show', $task->id)->with('success', 'Task updated successfully!');
    }

    /**
     * Add comment to task
     * 
     * @param Request $request Contains comment data
     * @param int $id Task ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $task = Task::findOrFail($id);
        
        TaskComment::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment
        ]);

        return redirect()->route('task.show', $task->id)->with('success', 'Comment added successfully!');
    }

    /**
     * Delete attachment
     * 
     * @param int $id Attachment ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAttachment($id)
    {
        $attachment = TaskAttachment::findOrFail($id);
        $taskId = $attachment->task_id;
        
        $attachment->delete();

        return redirect()->route('task.show', $taskId)->with('success', 'Attachment deleted successfully!');
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
     * Update specific task field via AJAX
     * 
     * @param Request $request Contains field and value
     * @param int $id Task ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateField(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        $field = $request->input('field');
        $value = $request->input('value');
        
        // Validate the field and value
        $allowedFields = ['task_type', 'priority', 'status', 'employee_id'];
        
        if (!in_array($field, $allowedFields)) {
            return response()->json(['success' => false, 'message' => 'Invalid field']);
        }
        
        // Validate values based on field
        if ($field === 'employee_id') {
            // Validate employee exists and belongs to the same employer
            if ($value) {
                $employee = Employee::find($value);
                if (!$employee) {
                    return response()->json(['success' => false, 'message' => 'Invalid employee']);
                }
                
                // Check if employee belongs to the same employer as the task
                if ($employee->employer_id !== $task->employer_id) {
                    return response()->json(['success' => false, 'message' => 'Employee does not belong to the same employer']);
                }
            }
        } else {
            $validValues = [
                'task_type' => ['task', 'story', 'bug', 'epic'],
                'priority' => ['low', 'medium', 'high'],
                'status' => ['pending', 'inprogress', 'completed']
            ];
            
            if (!in_array($value, $validValues[$field])) {
                return response()->json(['success' => false, 'message' => 'Invalid value']);
            }
        }
        
        // Update the task
        $task->$field = $value;
        $task->save();
        
        $response = [
            'success' => true, 
            'message' => 'Task updated successfully',
            'task' => $task
        ];
        
        // If updating employee, include employee name in response
        if ($field === 'employee_id' && $value) {
            $employee = Employee::find($value);
            $response['employee_name'] = $employee ? $employee->employee_name : null;
        }
        
        return response()->json($response);
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

    /**
     * Handle file uploads for task attachments
     * 
     * @param array $files Uploaded files
     * @param Task $task Task instance
     * @return void
     */
    private function handleFileUploads($files, Task $task)
    {
        foreach ($files as $file) {
            if ($file->isValid()) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::uuid() . '.' . $extension;
                $filePath = $file->storeAs('task-attachments', $fileName, 'public');

                TaskAttachment::create([
                    'task_id' => $task->id,
                    'user_id' => auth()->id(),
                    'original_name' => $originalName,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_type' => $extension,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);
            }
        }
    }
}
