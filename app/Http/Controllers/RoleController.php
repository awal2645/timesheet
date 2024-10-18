<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Role view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Role create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Role update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Role destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::where('id', '!=', 1)->latest()->get();

        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all(); // Assuming you have a Permission model

        return view('role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->permissions);
        Artisan::call('permission:cache-reset');

        return redirect()->back()->with('success', 'Role created successfully');
    }

    public function edit($id)
    {
        $role = Role::findOrfail($id);
        $permission = Permission::get();
        $role->permissions;

        return view('role.edit', ['role' => $role, 'permissions' => $permission]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrfail($id);
        $role->update(['name' => $request->role_name]);
        $role->syncPermissions($request->permissions);
        Artisan::call('permission:cache-reset');

        return redirect()->back()->with('success', 'Role Updated successfully');
    }

    public function destroy($id)
    {
        // Find the role by ID
        $role = Role::findOrFail($id);
    
        // Delete all users with this role name
        User::where('role', $role->name)->delete();
    
        // Now delete the role itself
        $role->delete();
    
        return redirect()->back()->with('success', 'Role and associated users deleted successfully');
    }
    
}
