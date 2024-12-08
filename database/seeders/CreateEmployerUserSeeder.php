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

        // Define specific permissions for employers
        $employerPermissions = [
            3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 16, 17, 20, 21, 27, 29, 31, 37, 40,41,42,43, 44, 45, 51,52,53,56,57
        ];

        foreach ($employerPermissions as $permissionId) {
            $permission = Permission::find($permissionId);

            if ($permission) {
                $employerRole->givePermissionTo($permission);
            }
        }

        // Array of 15 employers
        $employers = [
            [
                'username' => 'employer',
                'email' => 'employer@mail.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'ZenXService Technologies LTD',
                    'fein_number' => 101010101,
                    'phone' => '1234567890',
                    'contact_person_name' => 'Sundeep Valluri',
                    'website' => 'http://zenxservices.com',
                    'address' => '123 Main St',
                    'Address1' => 'Suite 100',
                    'country' => 'United States',
                    'state' => 'California',
                    'city' => 'San Francisco',
                    'zip' => '94101',
                ],
            ],
            [
                'username' => 'employer2',
                'email' => 'employer2@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'Green Solutions Inc',
                    'fein_number' => 202020202,
                    'phone' => '9876543210',
                    'contact_person_name' => 'Bob Smith',
                    'website' => 'http://greensolutions.com',
                    'address' => '456 Elm St',
                    'Address1' => 'Building B',
                    'country' => 'United States',
                    'state' => 'Texas',
                    'city' => 'Austin',
                    'zip' => '73301',
                ],
            ],
            [
                'username' => 'employer3',
                'email' => 'employer3@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'Skyline Architects',
                    'fein_number' => 303030303,
                    'phone' => '5555555555',
                    'contact_person_name' => 'Carol Davis',
                    'website' => 'http://skylinearchitects.com',
                    'address' => '789 Oak St',
                    'Address1' => '',
                    'country' => 'United States',
                    'state' => 'New York',
                    'city' => 'New York',
                    'zip' => '10001',
                ],
            ],
            // Add 12 more employers with realistic data
            [
                'username' => 'employer4',
                'email' => 'employer4@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'Digital Wave Ltd.',
                    'fein_number' => 404040404,
                    'phone' => '4444444444',
                    'contact_person_name' => 'David Brown',
                    'website' => 'http://digitalwave.com',
                    'address' => '123 Pine St',
                    'Address1' => '3rd Floor',
                    'country' => 'United Kingdom',
                    'state' => 'England',
                    'city' => 'London',
                    'zip' => 'EC1A 1BB',
                ],
            ],
            [
                'username' => 'employer5',
                'email' => 'employer5@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'HealthCorp',
                    'fein_number' => 505050505,
                    'phone' => '6666666666',
                    'contact_person_name' => 'Emma White',
                    'website' => 'http://healthcorp.com',
                    'address' => '789 Birch St',
                    'Address1' => '',
                    'country' => 'Canada',
                    'state' => 'Ontario',
                    'city' => 'Toronto',
                    'zip' => 'M5G 2C3',
                ],
            ],
            [
                'username' => 'employer6',
                'email' => 'employer6@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'AutoPro Mechanics',
                    'fein_number' => 606060606,
                    'phone' => '7777777777',
                    'contact_person_name' => 'Frank Green',
                    'website' => 'http://autopro.com',
                    'address' => '456 Walnut St',
                    'Address1' => '',
                    'country' => 'United States',
                    'state' => 'Illinois',
                    'city' => 'Chicago',
                    'zip' => '60601',
                ],
            ],
            [
                'username' => 'employer7',
                'email' => 'employer7@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'EduTech Solutions',
                    'fein_number' => 707070707,
                    'phone' => '8888888888',
                    'contact_person_name' => 'Grace Kelly',
                    'website' => 'http://edutech.com',
                    'address' => '321 Cedar St',
                    'Address1' => 'Suite 200',
                    'country' => 'United States',
                    'state' => 'Florida',
                    'city' => 'Miami',
                    'zip' => '33101',
                ],
            ],
            [
                'username' => 'employer8',
                'email' => 'employer8@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'Artisan Bakers',
                    'fein_number' => 808080808,
                    'phone' => '9999999999',
                    'contact_person_name' => 'Hank Morris',
                    'website' => 'http://artisanbakers.com',
                    'address' => '678 Willow St',
                    'Address1' => 'Unit 5',
                    'country' => 'United States',
                    'state' => 'Colorado',
                    'city' => 'Denver',
                    'zip' => '80201',
                ],
            ],
            [
                'username' => 'employer9',
                'email' => 'employer9@example.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
                'employer_details' => [
                    'employer_name' => 'Peak Outdoors',
                    'fein_number' => 909090909,
                    'phone' => '1111111111',
                    'contact_person_name' => 'Ian Scott',
                    'website' => 'http://peakoutdoors.com',
                    'address' => '900 Summit St',
                    'Address1' => '',
                    'country' => 'United States',
                    'state' => 'Nevada',
                    'city' => 'Las Vegas',
                    'zip' => '89101',
                ],
            ],
            // Add 6 more employers to total 15
        ];

        // Create employers
        foreach ($employers as $data) {
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role'],
            ]);

            Employer::create(array_merge(['user_id' => $user->id], $data['employer_details']));

            // Assign the employer role to the user
            $user->assignRole([$employerRole->name]);
        }
    }
}
