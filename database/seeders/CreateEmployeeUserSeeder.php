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

        // Define specific permissions for employee
        $employeePermissions = [7, 8, 17, 18, 19, 30];

        foreach ($employeePermissions as $permissionId) {
            $permission = Permission::find($permissionId);

            if ($permission) {
                $employeeRole->givePermissionTo($permission);
            }
        }

        // Create an employee user
        $employee = User::create([
            'username' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'employee',
        ]);

        Employee::create([
            'user_id' => $employee->id,
            'employee_name' => 'Employee',
            'employer_id' => 1,
            'phone' => '01763821693',
            'project_id' => 1,
            'gender' => 'male',
        ]);

        // Assign the employee role to the user
        $employee->assignRole([$employeeRole->name]);
    }
}
