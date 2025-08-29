<?php

namespace Modules\Notice\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Modules\Notice\App\Models\Notice;
use Illuminate\Http\Request;

/**
 * Controller for managing notices/announcements
 * Handles CRUD operations for notices with role-based visibility
 */
class NoticeController extends Controller
{
    protected $module_name;
    protected $module_enabled;
    public function __construct()
    {
        $this->module_name = 'Notice';
        $this->module_enabled = module_enabled($this->module_name);
        if (!$this->module_enabled) {
            abort(404);
        }
    }
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
        
        return view('notice::notices.index', compact('notices', 'roles'));
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
        return view('notice::notices.create', compact('roles'));
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
            'end_date' => 'nullable|date|after:now',
        ]);

        // Create new notice with role visibility
        Notice::create([
            'title' => $request->title,
            'content' => $request->content,
            'role' => implode(',', $request->role), // Store roles as comma-separated string
            'created_by' => auth()->id(), // Track who created the notice
            'status' => 'active',
            'end_date' => $request->end_date,
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
        $roles = Role::all();
        return view('notice::notices.edit', compact('notice', 'roles'));
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
            'end_date' => 'nullable|date|after:now',
        ]);

        // Update notice with new data
        $notice->update([
            'title' => $request->title,
            'content' => $request->content,
            'role' => implode(',', $request->role),
            'end_date' => $request->end_date,
        ]);

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove a notice
     * 
     * @param Notice $notice Notice to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();
        
        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice deleted successfully.');
    }

    /**
     * End a notice manually
     * 
     * @param Notice $notice Notice to end
     * @return \Illuminate\Http\RedirectResponse
     */
    public function end(Notice $notice)
    {
        $notice->update(['status' => 'ended']);
        
        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice has been ended.');
    }
}
