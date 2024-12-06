<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Employer;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve existing employers, clients, and projects
        $employers = Employer::all();
        $clients = Client::all();
        $projects = Project::all();

        // Check if there is sufficient data to create invoices
        if ($employers->isEmpty() || $clients->isEmpty() || $projects->isEmpty()) {
            return; // Exit the seeder if any required data is missing
        }

        // Create 15 sample invoices
        for ($i = 0; $i < 15; $i++) {
            Invoice::create([
                'employer_id' => $employers->random()->id,
                'client_id' => $clients->random()->id,
                'project_id' => $projects->random()->id,
                'invoice_number' => 'INV-' . Str::upper(Str::random(8)),
                'invoice_date' => now()->subDays(rand(0, 30)), // Random date within the last 30 days
                'status' => ['pending', 'paid', 'overdue'][rand(0, 2)], // Random status
            ]);
        }
    }
}
