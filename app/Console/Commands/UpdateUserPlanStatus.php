<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateUserPlanStatus extends Command
{
    protected $signature = 'userplans:update-status';

    protected $description = 'Update user plans and employer status if the plan has not been updated for 30 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Find all user plans where the updated_at date is older than 30 days
        $userPlans = DB::table('user_plans')
            ->where('updated_at', '<', $currentDate->subDays(30))
            ->get();

        foreach ($userPlans as $plan) {
            // Set the employer's status to false
            DB::table('employers')
                ->where('id', $plan->employer_id)
                ->update(['status' => false]);
        }

        $this->info('User plans and employer statuses have been updated.');
    }
}
