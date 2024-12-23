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
                'created_by' => '2',
            ],
            [
                'name' => 'Independence Day',
                'date' => '2024-07-04',
                'created_by' => '2',
            ],
            [
                'name' => 'Labor Day',
                'date' => '2024-09-02',
                'created_by' => '2',
            ],
            [
                'name' => 'Thanksgiving Day',
                'date' => '2024-11-28',
                'created_by' => '2',
            ],
            [
                'name' => 'Christmas Day',
                'date' => '2024-12-25',
                'created_by' => '2',
            ],
            [
                'name' => 'Martin Luther King Jr. Day',
                'date' => '2024-01-15',
                'created_by' => '2',
            ],
            [
                'name' => 'Memorial Day',
                'date' => '2024-05-27',
                'created_by' => '2',
            ],
            [
                'name' => 'Veterans Day',
                'date' => '2024-11-11',
                'created_by' => '2',
            ],
            [
                'name' => 'Good Friday',
                'date' => '2024-03-29',
                'created_by' => '2',
            ],
            [
                'name' => 'Easter Monday',
                'date' => '2024-04-01',
                'created_by' => '2',
            ],
        ];

        // Insert the holidays into the database
        foreach ($holidays as $holiday) {
            DB::table('holidays')->insert($holiday);
        }
    }
}
