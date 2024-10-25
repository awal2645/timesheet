<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming there is a Client with id = 1, an Employer with id = 1, and an Employee with id = 1
        $client = Client::find(1);
        $employer = Employer::find(1);
        $employee = Employee::find(1);

        // Check if the client, employer, and employee exist
        if ($client && $employer && $employee) {
            // Insert 10 sample projects
            for ($i = 1; $i <= 10; $i++) {
                // Randomly assign a payment type
                $paymentType = ['hourly', 'fixed', 'non'][array_rand(['hourly', 'fixed', 'non'])];

                // Determine budgets based on payment type
                $fixedBudget = null;
                $hrBudget = null;

                if ($paymentType == 'hourly') {
                    $hrBudget = $i * 50; // Example value for hourly budget
                } elseif ($paymentType == 'project') {
                    $fixedBudget = $i * 1000; // Example value for fixed budget
                }

                // Insert the project into the database
                Project::create([
                    'client_id' => $client->id,
                    'employer_id' => $employer->id,
                    'employee_id' => $employee->id,
                    'payment_type' => $paymentType,
                    'fixed_budget' => $fixedBudget,
                    'hr_budget' => $hrBudget,
                    'total_cost' => $hrBudget + $fixedBudget,
                    'project_name' => "Sample Project $i",
                    'status' => true, // Default status
                ]);
            }
        }
    }
}
