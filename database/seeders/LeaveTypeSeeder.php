<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of leave types with descriptions
        $leaveTypes = [
            [
                'type' => 'Sick Leave',
                'description' => 'Leave taken due to illness or medical reasons.',
                'created_by' => '2',
            ],
            [
                'type' => 'Casual Leave',
                'description' => 'Leave for personal matters or emergencies.',
                'created_by' => '2',
            ],
            [
                'type' => 'Annual Leave',
                'description' => 'Paid leave taken for vacations or personal time off.',
                'created_by' => '2',
            ],
            [
                'type' => 'Maternity Leave',
                'description' => 'Leave for childbirth and postnatal care.',
                'created_by' => '2',
            ],
            [
                'type' => 'Paternity Leave',
                'description' => 'Leave for fathers after the birth of their child.',
                'created_by' => '2',
            ],
            [
                'type' => 'Bereavement Leave',
                'description' => 'Leave taken after the loss of a family member.',
                'created_by' => '2',
            ],
            [
                'type' => 'Unpaid Leave',
                'description' => 'Leave taken without pay for personal reasons.',
                'created_by' => '2',
            ],
            [
                'type' => 'Study Leave',
                'description' => 'Leave taken to pursue further education or training.',
                'created_by' => '2',
            ],
        ];

        // Insert the leave types into the database
        foreach ($leaveTypes as $leaveType) {
            DB::table('leave_types')->insert($leaveType);
        }
    }
}
