<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Employer;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming there is an Employer with id = 1
        $employer = Employer::find(1);

        // Check if the employer exists
        if ($employer) {
            // Insert 5 clients with employer_id set to 1
            for ($i = 1; $i <= 12; $i++) {
                Client::create([
                    'employer_id' => $employer->id,
                    'client_name' => "Client $i",
                    'client_email' => "client$i@example.com",
                    'contact_name' => "Contact $i",
                    'client_phone' => "123-456-789$i",
                    'status' => true,
                ]);
            }
        }
    }
}
