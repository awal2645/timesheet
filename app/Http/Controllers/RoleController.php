<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

/**
 * Controller for managing user roles and permissions
 * Handles CRUD operations for roles with permission management
 */
class RoleController extends Controller
{
    /**
     * Set up middleware for role-based access control
     * Restricts access to role management functions
     */
    public function __construct()
    {
        $this->middleware('role_or_permission:Role view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Role create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Role update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Role destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of roles
     * Excludes super admin role (ID 1)
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all roles except super admin
        $roles = Role::where('id', '!=', 1)->latest()->get();
        return view('role.index', compact('roles'));
    }

    /**
     * Show form for creating a new role
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get all available permissions
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created role
     * 
     * @param Request $request Contains role name and permissions
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate role name
        $request->validate([
            'role_name' => 'required|unique:roles,name',
        ]);

        // Create role and assign permissions
        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->permissions);

        // Clear permission cache
        Artisan::call('permission:cache-reset');

        return redirect()->back()->with('success', 'Role created successfully');
    }

    /**
     * Show form for editing a role
     * 
     * @param int $id Role ID
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Get role and all permissions
        $role = Role::findOrfail($id);
        $permission = Permission::get();
        $role->permissions; // Load role permissions

        return view('role.edit', ['role' => $role, 'permissions' => $permission]);
    }

    /**
     * Update an existing role
     * 
     * @param Request $request Contains updated role data
     * @param int $id Role ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find role and update name and permissions
        $role = Role::findOrfail($id);
        $role->update(['name' => $request->role_name]);
        $role->syncPermissions($request->permissions);

        // Clear permission cache
        Artisan::call('permission:cache-reset');

        return redirect()->back()->with('success', 'Role Updated successfully');
    }

    /**
     * Remove a role and associated users
     * 
     * @param int $id Role ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find the role
        $role = Role::findOrFail($id);
    
        // Delete all users with this role name
        User::where('role', $role->name)->delete();
    
        // Delete the role itself
        $role->delete();
    
        return redirect()->back()->with('success', 'Role and associated users deleted successfully');
    }
}
