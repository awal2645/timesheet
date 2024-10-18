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
            // Insert a project with specific employee_id and employer_id
            for ($i = 1; $i <= 10; $i++) {
                Project::create([
                    'client_id' => $client->id,
                    'employer_id' => $employer->id,
                    'employee_id' => $employee->id,
                    'employee_share' => 1000.0,
                    'project_name' => "Sample Project $i",
                    'billing_rate' => 50.0,
                    'status' => true,
                ]);
            }
        }
    }
}
