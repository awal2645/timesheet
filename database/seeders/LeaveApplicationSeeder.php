<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\LeaveApplication;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LeaveApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve all employees and leave types from the database
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();

        // Check if there are any employees or leave types available
        if ($employees->isEmpty() || $leaveTypes->isEmpty()) {
            return; // Exit the seeder if no employees or leave types exist
        }

        // Define the number of leave applications to create
        $numLeaveApplications = 20; // Adjust as needed

        // Loop to create leave applications for employees
        for ($i = 0; $i < $numLeaveApplications; $i++) {
            $employee = $employees->random(); // Select a random employee
            $leaveType = $leaveTypes->random(); // Select a random leave type

            // Generate random start and end dates within a range
            $startDate = Carbon::now()->addDays(rand(1, 30)); // Start date within the next 30 days
            $endDate = $startDate->copy()->addDays(rand(1, 5)); // End date 1 to 5 days after the start date

            // Create a leave application with realistic data
            LeaveApplication::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'reason' => 'Vacation', // You can make this more varied if needed
                'status' => ['pending', 'approved', 'denied'][rand(0, 2)], // Random status
            ]);
        }
    }
}
