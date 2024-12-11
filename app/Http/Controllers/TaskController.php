<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\Notificattion;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->role == 'employee'){
            $tasks = Task::where('employee_id', auth()->user()->employee->id)->latest()->paginate(10);
        }elseif(auth()->user()->role == 'employer'){
            $tasks = Task::whereHas('employee', function ($query) {
                $query->where('employer_id', auth()->user()->employer->id);
            })->latest()->paginate(10);
        }else{
            $tasks = Task::latest()->paginate(10);
        }
        $projects = Project::all();
        return view('task.index', compact('tasks', 'projects'));
    }

    public function create()
    {
        $employers = Employer::all();
        $employees = Employee::all();
        $projects = Project::all();

        return view('task.create', compact('projects', 'employers', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'employee_id' => 'required|exists:employees,id',
            'project_id' => 'required|exists:projects,id',
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:pending,inprogress,completed',
            'due_date' => 'required|string|max:255',
        ]);

        Task::create([
            'employer_id' => $request->employer_id,
            'employee_id' => $request->employee_id,
            'project_id' => $request->project_id,
            'task_name' => $request->task_name,
            'time' => $request->time,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        // notification
        Notificattion::create([
            'message' => auth('web')->user()->username.' Task created',
            'from' => auth('web')->user()->id,
            'to' => $request->employee_id,
            'page_url' => '/task',
        ]);

        return redirect()->route('task.index')->with('success', 'Task created successfully!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $employers = Employer::all();
        $employees = Employee::all();
        $projects = Project::all();

        return view('task.edit', compact('task', 'employers', 'employees', 'projects'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'employee_id' => 'required|exists:employees,id',
            'project_id' => 'required|exists:projects,id',
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:pending,inprogress,completed',
            'due_date' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'employer_id' => $request->employer_id,
            'employee_id' => $request->employee_id,
            'project_id' => $request->project_id,
            'task_name' => $request->task_name,
            'time' => $request->time,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('task.index')->with('success', 'Task updated successfully!');
    }

    public function updateTime(Request $request, $id)
    {
        $task = Task::find($id);
        $task->time = $request->input('time');
        $task->save();
    
        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status = $request->input('status');
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task status updated successfully!');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task deleted successfully!');
    }
}
