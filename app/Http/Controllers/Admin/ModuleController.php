<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
   

    public function index()
    {
        $modules = Module::all();
        return view('admin.modules.index', compact('modules'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);
        $module->status = $request->status;
        $module->save();
        return response()->json(['success' => true, 'status' => $module->status]);
    }
} 