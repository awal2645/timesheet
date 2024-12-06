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
        $employeePermissions = [7, 8, 17, 18, 19, 30];

        foreach ($employeePermissions as $permissionId) {
            $permission = Permission::find($permissionId);

            if ($permission) {
                $employeeRole->givePermissionTo($permission);
            }
        }

        // Array of realistic employee details
        $employees = [
            ['username' => 'employee', 'email' => 'employee@mail.com', 'phone' => '01712345678', 'name' => 'Employee', 'gender' => 'male'],
            ['username' => 'jane_smith', 'email' => 'jane.smith@example.com', 'phone' => '01798765432', 'name' => 'Jane Smith', 'gender' => 'female'],
            ['username' => 'michael_brown', 'email' => 'michael.brown@example.com', 'phone' => '01756789012', 'name' => 'Michael Brown', 'gender' => 'male'],
            ['username' => 'emily_davis', 'email' => 'emily.davis@example.com', 'phone' => '01765432109', 'name' => 'Emily Davis', 'gender' => 'female'],
            ['username' => 'david_jones', 'email' => 'david.jones@example.com', 'phone' => '01778901234', 'name' => 'David Jones', 'gender' => 'male'],
            ['username' => 'lisa_wilson', 'email' => 'lisa.wilson@example.com', 'phone' => '01789012345', 'name' => 'Lisa Wilson', 'gender' => 'female'],
            ['username' => 'robert_taylor', 'email' => 'robert.taylor@example.com', 'phone' => '01790123456', 'name' => 'Robert Taylor', 'gender' => 'male'],
            ['username' => 'susan_clark', 'email' => 'susan.clark@example.com', 'phone' => '01723456789', 'name' => 'Susan Clark', 'gender' => 'female'],
            ['username' => 'james_miller', 'email' => 'james.miller@example.com', 'phone' => '01734567890', 'name' => 'James Miller', 'gender' => 'male'],
            ['username' => 'sarah_moore', 'email' => 'sarah.moore@example.com', 'phone' => '01745678901', 'name' => 'Sarah Moore', 'gender' => 'female'],
            ['username' => 'daniel_white', 'email' => 'daniel.white@example.com', 'phone' => '01756789023', 'name' => 'Daniel White', 'gender' => 'male'],
            ['username' => 'amanda_hall', 'email' => 'amanda.hall@example.com', 'phone' => '01767890123', 'name' => 'Amanda Hall', 'gender' => 'female'],
            ['username' => 'steven_lee', 'email' => 'steven.lee@example.com', 'phone' => '01778901234', 'name' => 'Steven Lee', 'gender' => 'male'],
            ['username' => 'patricia_king', 'email' => 'patricia.king@example.com', 'phone' => '01789012345', 'name' => 'Patricia King', 'gender' => 'female'],
            ['username' => 'chris_wright', 'email' => 'chris.wright@example.com', 'phone' => '01790123456', 'name' => 'Chris Wright', 'gender' => 'male'],
            ['username' => 'kimberly_green', 'email' => 'kimberly.green@example.com', 'phone' => '01701234567', 'name' => 'Kimberly Green', 'gender' => 'female'],
            ['username' => 'ryan_adams', 'email' => 'ryan.adams@example.com', 'phone' => '01712345678', 'name' => 'Ryan Adams', 'gender' => 'male'],
            ['username' => 'laura_turner', 'email' => 'laura.turner@example.com', 'phone' => '01723456789', 'name' => 'Laura Turner', 'gender' => 'female'],
            ['username' => 'mark_harris', 'email' => 'mark.harris@example.com', 'phone' => '01734567890', 'name' => 'Mark Harris', 'gender' => 'male'],
            ['username' => 'jessica_martin', 'email' => 'jessica.martin@example.com', 'phone' => '01745678901', 'name' => 'Jessica Martin', 'gender' => 'female'],
        ];

        // Assign employees to random employers
        foreach ($employees as $index => $data) {
            $randomEmployerId = rand(1, 9); // Ensure this is at least 1
            $randomProjectId = rand(1, 5); // Assuming 5 projects

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
                'gender' => $data['gender'],
            ]);

            // Assign the employee role to the user
            $user->assignRole([$employeeRole->name]);
        }
    }
}
