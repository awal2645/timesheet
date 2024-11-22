<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::paginate(10);
        return view('holidays.index', compact('holidays'));
    }

    public function create()
    {
        return view('holidays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Holiday::create($request->all());
        return redirect()->route('holidays.index')->with('success', 'Holiday created successfully.');
    }

    public function edit($id)
{
    $holiday = Holiday::findOrFail($id);
    return view('holidays.edit', compact('holiday'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|date',
    ]);

    $holiday = Holiday::findOrFail($id);
    $holiday->update($request->all());
    return redirect()->route('holidays.index')->with('success', 'Holiday updated successfully.');
}

public function destroy($id)
{
    $holiday = Holiday::findOrFail($id);
    $holiday->delete();
        return redirect()->route('holidays.index')->with('success', 'Holiday deleted successfully.');
    }
}
