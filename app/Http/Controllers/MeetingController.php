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

/**
 * Controller for managing Zoom meetings
 * Handles CRUD operations for meetings and integration with Zoom API
 */
class MeetingController extends Controller
{
    use ZoomMeetingTrait;

    // Meeting type constants as defined by Zoom API
    const MEETING_TYPE_INSTANT = 1;        // For instant meetings
    const MEETING_TYPE_SCHEDULE = 2;       // For scheduled meetings
    const MEETING_TYPE_RECURRING = 3;      // For recurring meetings
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;  // For fixed recurring meetings

    /**
     * Display a listing of meetings
     * Shows all meetings with their associated users and participants
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get meetings with related user and participant data
        $meetings = Meeting::latest()
            ->with(['user', 'participants.user:id,role'])
            ->paginate(15);
        
        // Get all users and roles for filtering/assignment
        $users = User::latest()->get(['id', 'username', 'email', 'role']);
        $roles = Role::latest()->get(['id', 'name']);

        return view('meetings.index', compact('meetings', 'users', 'roles'));
    }

    /**
     * Show the form for creating a new meeting
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get meetings with minimal pagination for reference
        $meetings = Meeting::latest()
            ->with(['user', 'participants.user:id,role'])
            ->paginate(15)
            ->onEachSide(-1);
        
        // Get users and roles for meeting assignment
        $users = User::latest()->get(['id', 'username', 'email', 'role']);
        $roles = Role::latest()->get(['id', 'name']);

        return view('meetings.create', compact('meetings', 'users', 'roles'));
    }

    /**
     * Store a newly created meeting
     * Creates both local meeting record and Zoom meeting
     * 
     * @param MeetingCreateRequest $request Validated meeting creation request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingCreateRequest $request)
    {
        // Check if Zoom configuration is available
        if (zMeetConfig()) {
            try {
                // Update user's Zoom credentials
                $user = auth()->user();
                $user->zoom_account_id = $request->zoom_account_id;
                $user->zoom_client_id = $request->zoom_client_id;
                $user->zoom_client_secret = $request->zoom_client_secret;
                $user->save();
                
                // Create Zoom meeting
                $meeting = $this->create_zoom($request, $user);

                // Create local meeting record
                (new CreateMeetingService)->create($meeting, $request);

                return redirect()
                    ->route('meeting.index')
                    ->with('success', 'Meeting Successfully Created');
            } catch (Exception $e) {
                return redirect()->back();
            }
        }

        return back();
    }

    /**
     * Update an existing meeting
     * Updates both local meeting record and Zoom meeting
     * 
     * @param MeetingCreateRequest $request Validated meeting update request
     * @param Meeting $meeting Meeting to update
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingCreateRequest $request, Meeting $meeting)
    {
        // Check if Zoom configuration is available
        if (zMeetConfig()) {
            try {
                // Update Zoom meeting
                $this->update_zoom($request, $meeting->meeting_id, auth()->user());
                $updated_meeting = $this->get_zoom($meeting->meeting_id, auth()->user());

                // Update local meeting record
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
     * Remove a meeting
     * Deletes both local meeting record and Zoom meeting
     * 
     * @param Meeting $meeting Meeting to delete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        try {
            // Delete Zoom meeting
            $this->delete_zoom($meeting->meeting_id, auth()->user());

            // Delete local meeting record
            $meeting->delete();
            
            return redirect()
                ->back()
                ->with('success', 'Meeting delete successfully.');
        } catch (Exception $e) {
            return back()
                ->withErrors(['error' => 'An error occurred while fetching transactions.']);
        }
    }
}

