<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'employer') {
            $leaveTypes = LeaveType::where('created_by', auth()->user()->id)->latest()->paginate(10);
        }elseif(auth()->user()->role === 'employee'){
            $leaveTypes = LeaveType::where('created_by', auth()->user()->employer->user->id)->latest()->paginate(10);
        }else{
            $leaveTypes = LeaveType::latest()->paginate(10);
        }
        return view('leave_types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('leave_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $request->merge(['created_by' => auth()->user()->id]);
        LeaveType::create($request->all('type', 'description', 'created_by'));
        return redirect()->route('leave_types.index')->with('success', 'Leave type created successfully.');
    }

    public function edit($id)
{
    $leaveType = LeaveType::findOrFail($id);
    return view('leave_types.edit', compact('leaveType'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'type' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $leaveType = LeaveType::findOrFail($id);
    $leaveType->update($request->all());
    return redirect()->route('leave_types.index')->with('success', 'Leave type updated successfully.');
}

public function destroy($id)
{
    $leaveType = LeaveType::findOrFail($id);
    $leaveType->delete();
    return redirect()->route('leave_types.index')->with('success', 'Leave type deleted successfully.');
}
}