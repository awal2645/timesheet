<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class InvoiceManagement extends Component
{
    public $projectId;
    public $totalCost = 0;

    public function updatedProjectId($value)
    {
        $this->calculateTotalCost($value);
    }

    public function calculateTotalCost($projectId)
    {
        $project = Project::with('tasks')->find($projectId);
        $totalMinutes = 0;

        foreach ($project->tasks as $task) {
            if (!empty($task->time) && strpos($task->time, ':') !== false) {
                $timeParts = explode(':', $task->time);
                $hours = isset($timeParts[0]) ? (int)$timeParts[0] : 0;
                $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;
                $taskMinutes = ($hours * 60) + $minutes;
                $totalMinutes += $taskMinutes;
            }
        }

        $totalHours = $totalMinutes / 60;
        $hrBudget = is_numeric($project->hr_budget) ? $project->hr_budget : 0;
        $this->totalCost = $totalHours * $hrBudget;
    }

    public function render()
    {
        $projects = Project::all();
        return view('livewire.invoice-management', compact('projects'));
    }
}