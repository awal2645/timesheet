<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        return view('themes.index');
    }

    public function update(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'theme' => 'required|string',
        ]);

        // Save theme preference (you might want to store this in the database or session)
        // Example: storing in session
        session(['theme' => $validated['theme']]);

        return redirect()->back()->with('success', 'Theme updated successfully');
    }
}
