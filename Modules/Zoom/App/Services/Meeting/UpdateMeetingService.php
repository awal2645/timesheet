<?php

namespace Modules\Zoom\App\Services\Meeting;

use Modules\Zoom\App\Models\Meeting;
use Modules\Zoom\App\Models\MeetingAttendee;

class UpdateMeetingService
{
    /**
     * Update an existing meeting record
     *
     * @param array $meeting Zoom meeting data
     * @param Meeting $meetingModel
     * @param \Illuminate\Http\Request $request
     * @return Meeting
     */
    public function update($meeting, $meetingModel, $request)
    {
        $meetingData = [
            'topic' => $request->topic,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'join_url' => $meeting['data']['join_url'],
        ];

        $meetingModel->update($meetingData);

        // Update meeting attendees
        if ($request->has('participants')) {
            // Remove existing attendees
            $meetingModel->participants()->delete();

            // Add new attendees
            foreach ($request->participants as $participant) {
                MeetingAttendee::create([
                    'meeting_id' => $meetingModel->id,
                    'user_id' => $participant,
                ]);
            }
        }

        return $meetingModel;
    }
} 