<?php

namespace App\Services\Meeting;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Meeting;
use App\Mail\NewMeetingAlertMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;

class CreateMeetingService
{
    public function create(array $meeting, object $request)
    {
        $created_meeting = Meeting::create([
            'meeting_id' => $meeting['data'] ? $meeting['data']['id'] : null,
            'meeting_uuid' => $meeting['data'] ? $meeting['data']['uuid'] : null,
            'host_id' => $meeting['data'] ? $meeting['data']['host_id'] : null,
            'host_email' => $meeting['data'] ? $meeting['data']['host_email'] : null,
            'topic' => $meeting['data'] ? $meeting['data']['topic'] : null,
            'description' => $meeting['data'] ? $meeting['data']['agenda'] : null,
            'type' => $meeting['data'] ? $meeting['data']['type'] : null,
            'status' => $meeting['data'] ? $meeting['data']['status'] : null,
            'start_time' => $meeting['data'] ? Carbon::parse($meeting['data']['start_time']) : null,
            'timezone' => $meeting['data'] ? $meeting['data']['timezone'] : null,
            'meeting_start_url' => $meeting['data'] ? $meeting['data']['start_url'] : null,
            'meeting_join_url' => $meeting['data'] ? $meeting['data']['join_url'] : null,
            'password' => $meeting['data'] ? $meeting['data']['password'] : null,
            'encrypted_password' => $meeting['data'] ? $meeting['data']['encrypted_password'] : null,
            'user_id' => auth()->id(),
        ]);

        $this->storeAttendee($created_meeting, $request);
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
