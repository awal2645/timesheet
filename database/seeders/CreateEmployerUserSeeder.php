<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateEmployerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employerRole = Role::find(2);

        // Define specific permissions for employees
        $employeePermissions =
        [
            3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 16, 17, 20, 21, 27, 29, 31, 41,44,45
        ];

        foreach ($employeePermissions as $permissionId) {
            $permission = Permission::find($permissionId);

            if ($permission) {
                $employerRole->givePermissionTo($permission);
            }
        }

        // Create an employee user
        $employer = User::create([
            'username' => 'employer',
            'email' => 'employer@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'employer',
        ]);

        Employer::create([
            'user_id' => $employer->id,
            'employer_name' => 'Employer',
            'fein_number' => 123456789,
            'phone' => '01763821693',
            'contact_person_name' => 'sundeep',
            'website' => 'http://localhost',
            'address' => 'Michigan',
            'Address1' => 'USA',
            'country' => 'United States',
            'state' => 'Michigan',
            'city' => 'Michigan',
            'zip' => '48006',
        ]);

        // Assign the employee role to the user
        $employer->assignRole([$employerRole->name]);
    }
}
