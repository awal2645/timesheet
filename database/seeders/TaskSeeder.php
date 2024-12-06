<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve existing employers, employees, and projects
        $employers = Employer::all();
        $employees = Employee::all();
        $projects = Project::all();

        // Check if there is sufficient data to create tasks
        if ($employers->isEmpty() || $employees->isEmpty() || $projects->isEmpty()) {
            return; // Exit the seeder if any required data is missing
        }

        // Create 20 sample tasks
        for ($i = 0; $i < 20; $i++) {
            Task::create([
                'employer_id' => $employers->random()->id,
                'employee_id' => $employees->random()->id,
                'project_id' => $projects->random()->id,
                'task_name' => 'Task ' . Str::random(6),
                'time' => str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . ':00',   
                'priority' => ['low', 'medium', 'high'][rand(0, 2)], // Random priority
                'due_date' => now()->addDays(rand(1, 30)), // Random due date within the next 30 days
                'status' => ['pending', 'inprogress', 'completed'][rand(0, 2)], // Random status
            ]);
        }
    }
}
