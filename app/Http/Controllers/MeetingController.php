<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meeting\MeetingCreateRequest;
use App\Models\Meeting;
use App\Models\User;
use App\Services\Meeting\CreateMeetingService;
use App\Services\Meeting\UpdateMeetingService;
use App\Traits\ZoomMeetingTrait;
use Exception;
use Spatie\Permission\Models\Role;

class MeetingController extends Controller
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;

    const MEETING_TYPE_SCHEDULE = 2;

    const MEETING_TYPE_RECURRING = 3;

    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
         $meetings  = Meeting::latest()->with(['user', 'participants.user:id,role'])->paginate(15);
         $users =User::latest()->get(['id', 'username', 'email', 'role']);
         $roles = Role::latest()->get(['id', 'name']);
 
         return view('meetings.index', compact('meetings', 'users', 'roles'));
     }

    public function create()
    {
        $meetings  = Meeting::latest()->with(['user', 'participants.user:id,role'])->paginate(15)->onEachSide(-1);
        $users =User::latest()->get(['id', 'username', 'email', 'role']);
        $roles = Role::latest()->get(['id', 'name']);

        return view('meetings.create', compact('meetings', 'users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingCreateRequest $request)
    {

        if (zMeetConfig()) {
            // try {
            $user = auth()->user();
            $user->zoom_account_id = $request->zoom_account_id;
            $user->zoom_client_id = $request->zoom_client_id;
            $user->zoom_client_secret = $request->zoom_client_secret;
            $user->save();
            
                $meeting = $this->create_zoom($request, $user);

                (new CreateMeetingService)->create($meeting, $request);

                return redirect()->route('meeting.index')->with('success', 'Meeting Successfully Created');

            // } catch (Exception $e) {

            //     return redirect()->back();
            // }
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingCreateRequest $request, Meeting $meeting)
    {

        if (zMeetConfig()) {
            try {
                $this->update_zoom($request, $meeting->meeting_id, auth()->user());
                $updated_meeting = $this->get_zoom($meeting->meeting_id, auth()->user());

                (new UpdateMeetingService)->update($updated_meeting, $meeting, $request);

                $this->flashSuccess('Meeting Successfully Updated');

                return back();
            } catch (Exception $e) {
                $this->flashWarning($e->getMessage());

                return redirect()->back();
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {

        try {
            $this->delete_zoom($meeting->meeting_id, auth()->user());

            $meeting->delete();
            return redirect()->back()->with('success', 'Meeting delete successfully.');

        } catch (Exception $e) {

            return back()->withErrors(['error' => 'An error occurred while fetching transactions.']);
        }
    }
}

