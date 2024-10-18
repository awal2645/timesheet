<?php

namespace App\Livewire;

use App\Models\Timesheet as TimesheetModel;
use Carbon\Carbon;
use Livewire\Component;

class Timesheet extends Component
{
    public $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    public $hours = [];

    public $dates = [];

    public $currentWeekStart;

    public $currentDate;

    public function mount()
    {
        // Retrieve existing timesheet data for the user and populate the $hours array
        $startDate = now()->startOfWeek(Carbon::SUNDAY)->format('m-d-y');
        $endDate = now()->addDays(6)->format('m-d-y');
        $existingTimesheets = TimesheetModel::where('user_id', auth()->user()->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        $this->hours = [];
        $this->dates = [];

        foreach ($existingTimesheets as $timesheet) {
            $this->hours[$timesheet->day] = $timesheet->hours;
            $this->dates[$timesheet->day] = $timesheet->date;
            $this->currentDate = $timesheet->date;
        }
        $currentDate = Carbon::createFromFormat('m-d-y', $startDate);
        foreach ($this->days as $day) {
            if (! isset($this->hours[$day])) {
                $this->hours[$day] = 0;
                $this->dates[$day] = $currentDate->format('m-d-y');
            }
            $currentDate->addDay(); // Increment the date by one day
        }
    }

    public function loadCurrentWeek()
    {
        $startDate = $this->currentWeekStart->format('m-d-y');
        $endDate = $this->currentWeekStart->copy()->addDays(6)->format('m-d-y');
        $timesheetData = TimesheetModel::where('user_id', auth()->user()->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        // Initialize hours and dates arrays
        $this->hours = [];
        $this->dates = [];

        foreach ($timesheetData as $timesheet) {
            $this->hours[$timesheet->day] = $timesheet->hours;
            $this->dates[$timesheet->day] = $timesheet->date;
            $this->currentDate = $timesheet->date;
        }

        // If no timesheet data exists for a day, set default values
        $currentDate = Carbon::createFromFormat('m-d-y', $startDate);
        foreach ($this->days as $day) {
            if (! isset($this->hours[$day])) {
                $this->hours[$day] = 0;
                $this->dates[$day] = $currentDate->format('m-d-y');
            }
            $currentDate->addDay(); // Increment the date by one day
        }

    }

    public function loadPreviousWeek()
    {
        $currentDate = now()->startOfWeek(Carbon::SUNDAY);
        $this->currentWeekStart = $currentDate; // Move to the start of the previous week
        $this->loadCurrentWeek();
    }

    public function loadNextWeek()
    {
        $currentDate = now()->startOfWeek(Carbon::SUNDAY);
        $this->currentWeekStart = $currentDate->subDays($currentDate->dayOfWeek)->addWeek(); // Move to the start of the next week
        $this->loadCurrentWeek();
    }

    public function render()
    {
        return view('livewire.time-sheet');
    }

    public function saveTimesheet()
    {
        // Save or update timesheet data in the database
        $user = auth()->user();

        foreach ($this->days as $day) {
            $date = $this->dates[$day];

            $existingTimesheet = TimesheetModel::where('user_id', $user->id)
                ->where('date', $date)
                ->first();

            if ($existingTimesheet) {
                // Update existing record
                $existingTimesheet->update([
                    'hours' => $this->hours[$day],
                ]);
            } else {
                // Create new record
                TimesheetModel::create([
                    'user_id' => $user->id,
                    'day' => $day,
                    'date' => $date,
                    'hours' => $this->hours[$day],
                ]);
            }
        }

        // Optionally, you can reset the input values after saving
        $this->reset(['hours', 'dates']);

        return redirect()->to('/timesheet/create');

    }
}
