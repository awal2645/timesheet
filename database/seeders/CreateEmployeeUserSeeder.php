<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateEmployeeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employeeRole = Role::find(3);

        // Define specific permissions for employees
        $employeePermissions = [7, 8, 17, 18, 19, 30,40,56];

        foreach ($employeePermissions as $permissionId) {
            $permission = Permission::find($permissionId);

            if ($permission) {
                $employeeRole->givePermissionTo($permission);
            }
        }

        // Array of realistic employee details
        $employees = [
            ['username' => 'employee', 'email' => 'employee@mail.com', 'phone' => '01712345678', 'name' => 'Employee One', 'gender' => 'male'],
            ['username' => 'employee2', 'email' => 'employee2@mail.com', 'phone' => '01798765432', 'name' => 'Jane Smith', 'gender' => 'female'],
            // Add more employees as needed
        ];

        foreach ($employees as $data) {
            $randomEmployerId = rand(1, 9); // Ensure this matches your employers table data
            $randomProjectId = rand(1, 5); // Assuming 5 projects
            $randomClientId = rand(1, 10); // Assuming 10 clients
            $billingRate = rand(100, 500) + rand(0, 99) / 100; // Random rate with 2 decimals
            $monthlySalary = rand(2000, 5000) + rand(0, 99) / 100; // Random salary with 2 decimals
            $paymentTypes = ['hourly', 'monthly', 'contract'];
            $totalLeave = rand(12, 30); // Random total leave days

            // Create the employee user
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt('123456'),
                'role' => 'employee',
            ]);

            // Create the employee record
            Employee::create([
                'user_id' => $user->id,
                'employee_name' => $data['name'],
                'employer_id' => $randomEmployerId,
                'phone' => $data['phone'],
                'project_id' => $randomProjectId,
                'client_id' => $randomClientId,
                'employee_share' => rand(5, 20), // Random percentage share
                'billing_rate' => $billingRate,
                'monthly_salary' => $monthlySalary,
                'payment_type' => $paymentTypes[array_rand($paymentTypes)],
                'total_leave' => $totalLeave,
                'gender' => $data['gender'],
            ]);

            // Assign the employee role to the user
            $user->assignRole([$employeeRole->name]);
        }
    }
}
