<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timesheet;
use App\Models\User;

class TimesheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Generate random timesheet entries for each user
            for ($i = 0; $i < 7; $i++) {
                Timesheet::create([
                    'user_id' => $user->id,
                    'day'     => now()->addDays($i)->format('l'), // Day of the week
                    'date'    => now()->addDays($i)->toDateString(),
                    'hours'   => rand(1, 8), // Random hours between 1 and 8
                ]);
            }
        }
    }
}
