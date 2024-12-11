<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for contacts
        $contacts = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '123-456-7890',
                'company' => 'Example Corp',
                'message' => 'Hello, I would like to inquire about your services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '098-765-4321',
                'company' => 'Sample Inc',
                'message' => 'I have a question regarding my order.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample contacts as needed
        ];

        // Insert sample data into the contacts table
        DB::table('contacts')->insert($contacts);
    }
}