<?php

namespace Database\Seeders;

use App\Models\PricePlan;
use Illuminate\Database\Seeder;

class PlanDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $plans = [
            [
                'label' => 'Free Plan',
                'description' => 'Company Essentials at No Cost: Boost Your Business',
                'price' => '0',
                'employee_limit' => '20',
                'client_limit' => '10',
                'project_limit' => '10',
                'recommended' => false,
                'frontend_show' => true,
            ],
            [
                'label' => 'Basic Plan',
                'description' => 'Foundational Solutions: Propel Your Company Forward',
                'price' => '20',
                'employee_limit' => '30',
                'client_limit' => '15',
                'project_limit' => '15',
                'recommended' => false,
                'frontend_show' => true,
            ],
            [
                'label' => 'Standard Plan',
                'description' => 'Premium Growth Tools: Accelerate Your Business Success',
                'price' => '50',
                'employee_limit' => '40',
                'client_limit' => '20',
                'project_limit' => '20',
                'recommended' => true,
                'frontend_show' => true,
            ],
            [
                'label' => 'VIP Plan',
                'description' => 'VIP Growth Tools: Accelerate Your Business Success',
                'price' => '500',
                'employee_limit' => '100',
                'client_limit' => '80',
                'project_limit' => '80',
                'recommended' => false,
                'frontend_show' => true,
            ],
        ];

        foreach ($plans as $plans) {
            PricePlan::create($plans);
        }
    }
}
