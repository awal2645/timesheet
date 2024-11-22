<?php

namespace App\Http\Controllers;

use App\Models\WeeklyHoliday;
use Illuminate\Http\Request;

class WeeklyHolidayController extends Controller
{
    public function index()
    {
        $holidays = WeeklyHoliday::paginate(10);
        return view('weekly_holidays.index', compact('holidays'));
    }

    public function create()
    {
        return view('weekly_holidays.create');
    }

    public function store(Request $request)
    {
        // dd(json_encode($request->days_of_week));
        $request->validate([
            'days_of_week' => 'required|array',
            'days_of_week.*' => 'string|max:255',
        ]);

        // Store the selected days as a JSON string
        WeeklyHoliday::create(['days_of_week' => json_encode($request->days_of_week)]);
        return redirect()->route('weekly_holidays.index')->with('success', 'Weekly holiday added successfully.');
    }

    public function edit($id)
    {
        $holiday = WeeklyHoliday::findOrFail($id);
        return view('weekly_holidays.edit', compact('holiday'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'days_of_week' => 'required|array',
            'days_of_week.*' => 'string|max:255',
        ]);
        $holiday = WeeklyHoliday::findOrFail($id);
        $holiday->update(['days_of_week' => json_encode($request->days_of_week)]);
        return redirect()->route('weekly_holidays.index')->with('success', 'Weekly holiday updated successfully.');
    }
    
    public function destroy($id)
    {
        $holiday = WeeklyHoliday::findOrFail($id);
        $holiday->delete();
        return redirect()->route('weekly_holidays.index')->with('success', 'Weekly holiday deleted successfully.');
    }
}