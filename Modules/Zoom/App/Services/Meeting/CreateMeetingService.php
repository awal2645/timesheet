<?php

namespace Modules\Zoom\App\Services\Meeting;

use Modules\Zoom\App\Models\Meeting;
use Modules\Zoom\App\Models\MeetingAttendee;

class CreateMeetingService
{
    /**
     * Create a new meeting record
     *
     * @param array $meeting Zoom meeting data
     * @param \Illuminate\Http\Request $request
     * @return Meeting
     */
    public function create($meeting, $request)
    {
        $meetingData = [
            'user_id' => auth()->id(),
            'meeting_id' => $meeting['data']['id'],
            'topic' => $request->topic,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'join_url' => $meeting['data']['join_url'],
        ];

        $meeting = Meeting::create($meetingData);

        // Create meeting attendees
        if ($request->has('participants')) {
            foreach ($request->participants as $participant) {
                MeetingAttendee::create([
                    'meeting_id' => $meeting->id,
                    'user_id' => $participant,
                ]);
            }
        }

        return $meeting;
    }
} 