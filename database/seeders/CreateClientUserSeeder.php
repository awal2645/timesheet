<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clientRole = Role::find(4);

        // Define specific permissions for employees
        $clientPermissions =
        [
             13, 14, 16, 17
        ];

        foreach ($clientPermissions as $permissionId) {
            $permission = Permission::find($permissionId);

            if ($permission) {
                $clientRole->givePermissionTo($permission);
            }
        }

        // Create an employee user
        $client = User::create([
            'username' => 'client',
            'email' => 'client@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'client',
        ]);

        Client::create([
            'employer_id' => 1,
            'client_name' => "Client",
            'client_email' => "client@gmail.com",
            'contact_name' => "Contact Name",
            'client_phone' => "123-456-789$",
            'status' => true,
        ]);

        // Assign the employee role to the user
        $client->assignRole([$clientRole->name]);
    }
}
