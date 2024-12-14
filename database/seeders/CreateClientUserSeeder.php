<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;
use App\Models\Employer;

class CreateClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 users with real data
        $users = [
            User::create(['name' => 'Client', 'username' => 'client', 'role' => 'client', 'email' => 'client@example.com', 'password' => bcrypt('password')]),
            User::create(['name' => 'Client2', 'username' => 'client2', 'role' => 'client', 'email' => 'client2@example.com', 'password' => bcrypt('password')]),
            User::create(['name' => 'Client3', 'username' => 'client3', 'role' => 'client', 'email' => 'client3@example.com', 'password' => bcrypt('password')]),
        ];

        // Fetch some employers to associate with clients
        $employers = Employer::all();

        if ($employers->isEmpty()) {
            $this->command->info('No employers found. Please seed the Employers table first.');
            return;
        }

        foreach (range(1, 10) as $index) {
            Client::create([
                'user_id' => $users[array_rand($users)]->id,
                'employer_id' => $employers->random()->id,
                'client_name' => "Client Name $index",
                'client_email' => "client$index@example.com",
                'contact_name' => "Contact Name $index",
                'status' => (bool)random_int(0, 1),
                'client_phone' => '+123456789' . $index,
            ]);
        }
    }
}
