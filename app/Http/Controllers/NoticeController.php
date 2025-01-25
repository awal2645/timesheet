<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Notice;
use Illuminate\Http\Request;

/**
 * Controller for managing notices/announcements
 * Handles CRUD operations for notices with role-based visibility
 */
class NoticeController extends Controller
{
    /**
     * Display a paginated list of notices with role information
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get latest notices with pagination (10 per page)
        $notices = Notice::latest()->paginate(10);
        
        // Get all roles for notice filtering/assignment
        $roles = Role::all();
        
        return view('notices.index', compact('notices', 'roles'));
    }

    /**
     * Show form for creating a new notice
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get all roles for notice visibility assignment
        $roles = Role::all();
        return view('notices.create', compact('roles'));
    }

    /**
     * Store a newly created notice
     * 
     * @param Request $request Contains notice data and role assignments
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate notice data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'role' => 'nullable|array', // Role visibility is optional
        ]);

        // Create new notice with role visibility
        Notice::create([
            'title' => $request->title,
            'content' => $request->content,
            'role' => implode(',', $request->role), // Store roles as comma-separated string
            'created_by' => auth()->id(), // Track who created the notice
        ]);

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice created successfully.');
    }

    /**
     * Show form for editing a notice
     * 
     * @param Notice $notice Notice to edit
     * @return \Illuminate\View\View
     */
    public function edit(Notice $notice)
    {
        return view('notices.edit', compact('notice'));
    }

    /**
     * Update an existing notice
     * 
     * @param Request $request Contains updated notice data
     * @param Notice $notice Notice to update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Notice $notice)
    {
        // Validate updated notice data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'role' => 'nullable|array', // Role visibility is optional
        ]);

        // Update notice with new data
        $notice->update($request->only('title', 'content', 'role'));

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove a notice
     * 
     * @param int $id Notice ID to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find and delete the notice
        $notice = Notice::find($id);
        $notice->delete();
        
        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice deleted successfully.');
    }
}