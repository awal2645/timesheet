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
    public function run(): void
    {
        // Get the client role
        $clientRole = Role::find(4);

        if ($clientRole) {
            // Define specific permissions for clients
            $clientPermissions = [13, 14, 16, 17];

            // Assign permissions to the client role
            foreach ($clientPermissions as $permissionId) {
                $permission = Permission::find($permissionId);
                if ($permission) {
                    $clientRole->givePermissionTo($permission);
                }
            }

            // Check if employer with ID 1 exists
            $employer = Employer::find(1);

            if ($employer) {
                // Define a list of clients with their associated user data
                $clients = [
                    [
                        'user' => [
                            'username' => 'client',
                            'email' => 'client@mail.com',
                            'password' => bcrypt('123456'),
                            'role' => 'client',
                        ],
                        'client' => [
                            'client_name' => 'Acme Corp',
                            'contact_name' => 'John Doe',
                            'client_phone' => '555-123-4567',
                            'status' => true,
                        ],
                    ],
                    [
                        'user' => [
                            'username' => 'client2',
                            'email' => 'client2@gmail.com',
                            'password' => bcrypt('123456'),
                            'role' => 'client',
                        ],
                        'client' => [
                            'client_name' => 'Tech Innovations',
                            'contact_name' => 'Jane Smith',
                            'client_phone' => '555-234-5678',
                            'status' => true,
                        ],
                    ],
                    [
                        'user' => [
                            'username' => 'client3',
                            'email' => 'client3@gmail.com',
                            'password' => bcrypt('123456'),
                            'role' => 'client',
                        ],
                        'client' => [
                            'client_name' => 'Global Enterprises',
                            'contact_name' => 'Emily Johnson',
                            'client_phone' => '555-345-6789',
                            'status' => true,
                        ],
                    ],
                ];

                // Loop through each client and create both user and client records
                foreach ($clients as $clientData) {
                    // Create the user
                    $clientUser = User::create($clientData['user']);

                    if ($clientUser) {
                        // Assign the client role to the user
                        $clientUser->assignRole([$clientRole->name]);

                        // Create the client record associated with the employer
                        Client::create(array_merge(
                            $clientData['client'],
                            ['employer_id' => $employer->id, 'client_email' => $clientData['user']['email']]
                        ));
                    }
                }
            }
        }
    }
}
