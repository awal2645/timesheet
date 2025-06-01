<?php

namespace App\Services\Meeting;

use Carbon\Carbon;
use App\Models\User;
use Modules\Zoom\App\Models\Meeting;
use Modules\Zoom\App\Models\MeetingAttendee;
use App\Mail\NewMeetingAlertMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;

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

    public function storeAttendee(object $meeting, object $request): void
    {
        if ($request->all_user) {
            $role = $request->selected_role;
            $users = User::where('role', $role)->get();
        } else {
            $users = User::whereIn('id', $request->participants)->get();

        }
        try{

        foreach ($users as $key => $user) {
            
            $meeting->participants()->create([
                'user_id' => $user->id,
            ]);
            if(auth()->user()->role == 'employer'){
                $smtp = smtp();
                Config::set('mail.mailers.smtp', [
                    'transport' => 'smtp',
                    'host' => $smtp->host,
                    'port' => $smtp->port,
                    'encryption' => $smtp->encryption,
                    'username' => $smtp->username,
                    'password' => $smtp->password,
                    'from' => [
                        'address' => $smtp->mail_from_address,
                        'name' => $smtp->mail_from_name,
                    ],
                ]);
                Config::set('mail.default', 'smtp');
                Mail::to($user->email)->send(new NewMeetingAlertMail($user, $meeting));
            }else{
                Mail::to($user->email)->send(new NewMeetingAlertMail($user, $meeting));
            }
        }
    } catch (\Exception $e) {
            // return redirect()->back()->with('error', 'Please try again later.');
        }
    }
}
