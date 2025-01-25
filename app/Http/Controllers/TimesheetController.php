<?php

namespace App\Http\Controllers;

use App\Mail\TimesheetReportMail;
use App\Models\Employer;
use App\Models\Notificattion;
use App\Models\TimeReport;
use App\Models\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Controller for managing employee timesheets
 * Handles timesheet creation, submission, and reporting
 */
class TimesheetController extends Controller
{
    /**
     * Display timesheet form for a specific week
     * 
     * @param string|null $startDate Starting date of the week
     * @return \Illuminate\View\View
     */
    public function index($startDate = null)
    {
        // Define days of the week
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        // Set current week start date
        if ($startDate) {
            $currentDate = Carbon::createFromFormat('m-d-y', $startDate)->startOfWeek(Carbon::SUNDAY);
        } else {
            $currentDate = now()->startOfWeek(Carbon::SUNDAY);
        }

        // Set date range for the week
        $startDate = $currentDate->copy();
        $endDate = $currentDate->copy()->addDays(6);
        $hours = [];
        $dates = [];

        // Get existing timesheet entries for the week
        $existingTimesheets = Timesheet::where('user_id', auth()->user()->id)
            ->whereBetween('date', [$startDate->format('m-d-y'), $endDate->format('m-d-y')])
            ->get();

        // Populate hours and dates arrays with existing data
        foreach ($existingTimesheets as $timesheet) {
            $hours[$timesheet->day] = $timesheet->hours;
            $dates[$timesheet->day] = $timesheet->date;
        }

        // Initialize remaining days with default values
        $currentDate = $startDate->copy();
        foreach ($days as $day) {
            if (!isset($hours[$day])) {
                $hours[$day] = 0;
                $dates[$day] = $currentDate->format('m-d-y');
            }
            $currentDate->addDay();
        }

        // Get time report for the week if exists
        $timeReport = TimeReport::where('start_day', $startDate->format('m-d-y'))
            ->where('end_day', $endDate->format('m-d-y'))
            ->where('user_id', auth()->user()->id)
            ->first();

        return view('timesheet.create', compact('days', 'hours', 'dates', 'startDate', 'timeReport'));
    }

    /**
     * Save timesheet entries without submitting
     * 
     * @param Request $request Contains timesheet data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveTimesheet(Request $request)
    {
        // Validate timesheet hours
        $request->validate([
            'hours.*' => 'required|numeric|min:0|max:24',
        ], [
            'hours.*.required' => 'The :attribute field is required.',
            'hours.*.numeric' => 'The :attribute must be a number.',
            'hours.*.min' => 'Please input valid hours',
        ]);

        try {
            // Check user role
            if (auth()->user()->role != 'employee') {
                return redirect()->back()->with('error', 'Only Employee can create report');
            }

            $user = auth()->user();
            
            // Check existing time report
            $timeReport = TimeReport::where('start_day', $request->start_day)
                ->where('end_day', $request->end_day)
                ->where('user_id', $user->id)
                ->first();

            // Prevent updates to submitted reports
            if ($timeReport) {
                if ($timeReport->status == 'approve' || $timeReport->status == 'decline') {
                    return redirect()->back()->with('error', 'This week report already submitted');
                }
            }

            // Save or update timesheet entries
            foreach ($request->input('hours') as $day => $hours) {
                $date = $request->input('dates')[$day];

                $existingTimesheet = Timesheet::where('user_id', $user->id)
                    ->where('date', $date)
                    ->first();

                if ($existingTimesheet) {
                    // Update existing record
                    $existingTimesheet->update([
                        'hours' => $hours,
                    ]);
                } else {
                    // Create new record
                    Timesheet::create([
                        'user_id' => $user->id,
                        'day' => $day,
                        'date' => $date,
                        'hours' => $hours,
                    ]);
                }
            }

            // Handle image upload and report creation
            if ($request->file('image')) {
                $this->handleImageUpload($request, $timeReport, $user);
            } else if ($request->comment) {
                $timeReport->comment = $request->comment;
                $timeReport->save();
            }

            return redirect()->back()->with('success', 'Report added successfully');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Error: '.$e->getMessage());
        }
    }

    /**
     * Submit timesheet for approval
     * 
     * @param Request $request Contains timesheet data and image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitTimesheet(Request $request)
    {
        // Validate image upload
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,webp',
        ]);

        try {
            // Validate timesheet hours
            $request->validate([
                'hours.*' => 'required|numeric|min:0',
            ], [
                'hours.*.required' => 'The :attribute field is required.',
                'hours.*.numeric' => 'The :attribute must be a number.',
                'hours.*.min' => 'The :attribute must be at least :min.',
            ]);

            // Check user role
            if (auth()->user()->role != 'employee') {
                return redirect()->back()->with('error', 'Only Employee can create report');
            }

            $user = auth()->user();
            
            // Check existing time report
            $timeReport = TimeReport::where('start_day', $request->start_day)
                ->where('end_day', $request->end_day)
                ->where('user_id', $user->id)
                ->first();

            // Prevent duplicate submissions
            if ($timeReport) {
                return redirect()->back()->with('error', 'This week report already submitted');
            }

            // Save timesheet entries
            foreach ($request->input('hours') as $day => $hours) {
                $date = $request->input('dates')[$day];

                $existingTimesheet = Timesheet::where('user_id', $user->id)
                    ->where('date', $date)
                    ->first();

                if ($existingTimesheet) {
                    // Update existing record
                    $existingTimesheet->update([
                        'hours' => $hours,
                    ]);
                } else {
                    // Create new record
                    Timesheet::create([
                        'user_id' => $user->id,
                        'day' => $day,
                        'date' => $date,
                        'hours' => $hours,
                    ]);
                }
            }

            // Handle image upload and report creation
            if ($request->file('image')) {
                $this->handleImageUpload($request, $timeReport, $user);

                // Send email notification
                $this->sendEmailNotification($user);
            }

            return redirect()->back()->with('success', 'Report added successfully');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Error: '.$e->getMessage());
        }
    }

    /**
     * Handle image upload and report creation
     * 
     * @param Request $request Request object
     * @param TimeReport|null $timeReport Existing time report
     * @param User $user Current user
     */
    private function handleImageUpload($request, $timeReport, $user)
    {
        // Process image upload
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('reports_images'), $imageName);

        if ($timeReport) {
            if ($timeReport->status == 'pending') {
                // Update existing report
                $timeReport->image = 'reports_images/'.$imageName;
                $timeReport->comment = $request->comment;
                $timeReport->save();
            } else {
                return redirect()->back()->with('error', 'This week report already submitted');
            }
        } else {
            // Create new time report
            $timeReport = new TimeReport;
            $timeReport->image = 'reports_images/'.$imageName;
            $timeReport->user_id = $user->id;
            $timeReport->employer_id = $user->employee->employer_id;
            $timeReport->employee_id = $user->employee->id;
            $timeReport->comment = $request->comment;
            $timeReport->start_day = $request->start_day;
            $timeReport->end_day = $request->end_day;
            $timeReport->save();
        }

        // Create notification
        $employer = Employer::findOrFail($user->employee->employer_id);
        Notificattion::create([
            'message' => $user->username.' Create a new report',
            'from' => $user->id,
            'to' => $employer->user->id,
        ]);
    }

    /**
     * Send email notification for timesheet submission
     * 
     * @param User $user Current user
     */
    private function sendEmailNotification($user)
    {
        $employer = Employer::findOrFail($user->employee->employer_id);
        
        if ($employer->user->email) {
            // Get email template
            $emailTemplate = DB::table('email_templates')
                ->where('type', 'timesheet_submission')
                ->first();

            if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                // Format email content
                $formattedBody = getFormattedTextByType('timesheet_submission', [
                    'app_name' => config('app.name'),
                    'name' => $user->name,
                    'year' => date('Y'),
                    'link' => url('/reports'),
                ]);

                // Send email
                Mail::to($employer->user->email)->send(new TimesheetReportMail(
                    $emailTemplate->subject, 
                    $formattedBody
                ));
            }
        }
    }
}
