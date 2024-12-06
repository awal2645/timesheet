<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of holidays with their names and dates
        $holidays = [
            [
                'name' => 'New Year\'s Day',
                'date' => '2024-01-01',
            ],
            [
                'name' => 'Independence Day',
                'date' => '2024-07-04',
            ],
            [
                'name' => 'Labor Day',
                'date' => '2024-09-02',
            ],
            [
                'name' => 'Thanksgiving Day',
                'date' => '2024-11-28',
            ],
            [
                'name' => 'Christmas Day',
                'date' => '2024-12-25',
            ],
            [
                'name' => 'Martin Luther King Jr. Day',
                'date' => '2024-01-15',
            ],
            [
                'name' => 'Memorial Day',
                'date' => '2024-05-27',
            ],
            [
                'name' => 'Veterans Day',
                'date' => '2024-11-11',
            ],
            [
                'name' => 'Good Friday',
                'date' => '2024-03-29',
            ],
            [
                'name' => 'Easter Monday',
                'date' => '2024-04-01',
            ],
        ];

        // Insert the holidays into the database
        foreach ($holidays as $holiday) {
            DB::table('holidays')->insert($holiday);
        }
    }
}
