<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Client;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Employer;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // try {

        $tasks = Task::all();
        $projects = Project::all();
        // Return the view with the filtered projects
        return view('task.index', compact('tasks', 'projects'));
        // } catch (\Exception $e) {
        //     // Handle the exception and redirect back with an error message
        //     return redirect()
        //         ->back()
        //         ->with(['error' => 'An error occurred while loading the projects. Please try again later.']);
        // }
    }

    public function create()
    {
        $clients = Client::all();
        $employers = Employer::all();
        $employees = Employee::all();
        $projects = Project::all();


        return view('task.create', compact('projects', 'clients', 'employers', 'employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employer_id' => 'required|exists:employers,id',
            'employee_id' => 'required|exists:employees,id',
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:pending,inprogress,completed',
            'due_date' => 'required|string|max:255',
        ]);
        Task::create([
            'client_id' => $request->client_id,
            'employer_id' => $request->employer_id,
            'employee_id' => $request->employee_id,
            'task_name' => $request->task_name,
            'time' => $request->time,
            'status' => $request->status,
        ]);

        return redirect()->route('task.index')->with('success', 'Task created successfully!');
    }

    public function updateTime(Request $request, $id)
{
    $task = Task::find($id);
    $task->time = $request->input('time');
    $task->save();

    return response()->json(['success' => true]);
}

}
