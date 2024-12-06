<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimeReport;
use App\Models\User;
use App\Models\Employer;
use App\Models\Employee;

class TimeReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $user = User::find($employee->user_id);
            $employer = Employer::find($employee->employer_id);

            if ($user && $employer) {
                // Create a TimeReport entry for each employee
                TimeReport::create([
                    'user_id' => $user->id,
                    'employer_id' => $employer->id,
                    'employee_id' => $employee->id,
                    'image' => 'reports_images/dummy_image.png', // Replace with actual image path
                    'status' => 'pending', // Default status
                    'feedback' => null, // No feedback by default
                    'comment' => 'This is a test comment.', // Example comment
                    'start_day' => now()->subDays(7)->toDateString(),
                    'end_day' => now()->toDateString(),
                ]);
            }
        }
    }
}
