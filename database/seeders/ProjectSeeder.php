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
        // Fetch existing client, employer, and employee records
        $client = Client::find(1);
        $employer = Employer::find(1);
        $employee = Employee::find(1);

        // Check if the client, employer, and employee exist
        if ($client && $employer && $employee) {
            // Define a list of realistic project names and details
            $projects = [
                ['name' => 'Website Redesign', 'description' => 'Revamp the client’s corporate website.'],
                ['name' => 'Mobile App Development', 'description' => 'Develop a cross-platform mobile app.'],
                ['name' => 'Digital Marketing Campaign', 'description' => 'Execute an SEO and social media campaign.'],
                ['name' => 'E-commerce Platform Setup', 'description' => 'Build and deploy an online store.'],
                ['name' => 'Database Optimization', 'description' => 'Optimize database performance and queries.'],
                ['name' => 'Cloud Migration', 'description' => 'Migrate on-premises infrastructure to the cloud.'],
                ['name' => 'Brand Strategy', 'description' => 'Develop a comprehensive branding strategy.'],
                ['name' => 'CRM Integration', 'description' => 'Integrate a customer relationship management tool.'],
                ['name' => 'IT Infrastructure Setup', 'description' => 'Set up servers, networking, and security.'],
                ['name' => 'User Training Program', 'description' => 'Conduct training sessions for end-users.'],
            ];

            // Loop through projects and create them in the database
            foreach ($projects as $index => $project) {
                // Randomly assign a payment type
                $paymentType = ['hourly', 'fixed', 'non'][array_rand(['hourly', 'fixed', 'non'])];

                // Randomly determine budgets based on payment type
                $fixedBudget = null;
                $hrBudget = null;

                if ($paymentType === 'hourly') {
                    $hrBudget = rand(50, 200) * 10; // Example hourly budget range
                } elseif ($paymentType === 'fixed') {
                    $fixedBudget = rand(1000, 10000); // Example fixed budget range
                }

                // Calculate total cost
                $totalCost = ($hrBudget ?? 0) + ($fixedBudget ?? 0);

                // Create the project record
                Project::create([
                    'client_id' => $client->id,
                    'employer_id' => $employer->id,
                    'employee_id' => $employee->id,
                    'payment_type' => $paymentType,
                    'fixed_budget' => $fixedBudget,
                    'hr_budget' => $hrBudget,
                    'total_cost' => $totalCost,
                    'project_name' => $project['name'],
                    'status' => true, // Default status to active
                ]);
            }
        }
    }
}
