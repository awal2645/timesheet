<?php

namespace Database\Seeders;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve all users to assign the `created_by` field
        $users = User::all();

        // Check if there are any users available
        if ($users->isEmpty()) {
            return; // Exit the seeder if no users exist
        }

        // Create some sample notices
        $notices = [
            [
                'title' => 'System Maintenance Scheduled',
                'content' => 'Please be advised that the system will be undergoing scheduled maintenance on Saturday, 9th December from 1:00 AM to 5:00 AM. During this time, some services may be unavailable.',
                'role' => '2',
            ],
            [
                'title' => 'Project Deadline Reminder',
                'title' => 'Project Deadline Reminder',
                'content' => 'This is a reminder that the deadline for the current project is next Friday, 15th December. Please ensure all deliverables are submitted by then.',
                'role' => '3',
            ],
            [
                'title' => 'Annual Leave Policy Update',
                'content' => 'The annual leave policy has been updated to reflect new guidelines. Please review the updated policy in the employee handbook or contact HR for further details.',
                'role' => '3',
            ],
            [
                'title' => 'New Employee Orientation',
                'content' => 'We are excited to welcome new employees joining our team. A mandatory orientation session will be held on Monday, 11th December at 10:00 AM in the main conference room.',
                'role' => '4',
            ],
            [
                'title' => 'Holiday Party Invitation',
                'content' => 'Join us for our annual holiday party on Friday, 22nd December. There will be food, drinks, and entertainment! RSVP by 15th December to secure your spot.',
                'role' => '4',
            ],
        ];

        // Loop through each notice and create a record
        foreach ($notices as $noticeData) {
            Notice::create([
                'title' => $noticeData['title'],
                'content' => $noticeData['content'],
                'role' => $noticeData['role'],
                'created_by' => $users->random()->id, // Assign a random user as the creator
            ]);
        }
    }
}
