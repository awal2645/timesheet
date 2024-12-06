<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\PricePlan;
use App\Models\UserPlan;
use Illuminate\Database\Seeder;

class UserPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employers = Employer::all();
        $pricePlans = PricePlan::all();

        if ($employers->isEmpty() || $pricePlans->isEmpty()) {
            return; // Exit if there is not enough data to create user plans
        }

        // Create sample user plans for each employer
        foreach ($employers as $employer) {
            foreach ($pricePlans as $pricePlan) {
                UserPlan::create([
                    'employer_id' => $employer->id,
                    'price_plans_id' => $pricePlan->id,
                    'employee_limit' => rand(1, 100),
                    'client_limit' => rand(1, 50),
                    'project_limit' => rand(1, 30),
                    'free_plan' => (bool) rand(0, 1),
                ]);
            }
        }
    }
}
