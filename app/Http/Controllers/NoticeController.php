<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->paginate(10);
        $roles = Role::all();
        return view('notices.index', compact('notices', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('notices.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'role' => 'nullable|array', // Validate role if needed
        ]);

        Notice::create([
            'title' => $request->title,
            'content' => $request->content,
            'role' => implode(',', $request->role),
            'created_by' => auth()->id(), // Store the ID of the user creating the notice
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice created successfully.');
    }

    public function edit(Notice $notice)
    {
        return view('notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'role' => 'nullable|array', // Validate role if needed
        ]);

        $notice->update($request->only('title', 'content', 'role'));

        return redirect()->route('notices.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy($id)
    {
        $notice = Notice::find($id);
        $notice->delete();
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully.');
    }
}