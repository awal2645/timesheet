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

class TimesheetController extends Controller
{
    public function index($startDate = null)
    {
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        if ($startDate) {
            $currentDate = Carbon::createFromFormat('m-d-y', $startDate)->startOfWeek(Carbon::SUNDAY);
        } else {
            $currentDate = now()->startOfWeek(Carbon::SUNDAY);
        }

        $startDate = $currentDate->copy();
        $endDate = $currentDate->copy()->addDays(6);
        $hours = [];
        $dates = [];

        // Retrieve existing timesheet data for the user and populate the $hours array
        $existingTimesheets = Timesheet::where('user_id', auth()->user()->id)
            ->whereBetween('date', [$startDate->format('m-d-y'), $endDate->format('m-d-y')])
            ->get();

        foreach ($existingTimesheets as $timesheet) {
            $hours[$timesheet->day] = $timesheet->hours;
            $dates[$timesheet->day] = $timesheet->date;
        }

        // Initialize remaining days with default values
        $currentDate = $startDate->copy();
        foreach ($days as $day) {
            if (! isset($hours[$day])) {
                $hours[$day] = 0;
                $dates[$day] = $currentDate->format('m-d-y');
            }
            $currentDate->addDay();
        }
        $timeReport = TimeReport::where('start_day', $startDate->format('m-d-y'))
            ->where('end_day', $endDate->format('m-d-y'))
            ->where('user_id', auth()->user()->id)
            ->first();

        return view('timesheet.create', compact('days', 'hours', 'dates', 'startDate', 'timeReport'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function saveTimesheet(Request $request)
    {

        $request->validate([
            'hours.*' => 'required|numeric|min:0|max:24',
        ], [
            'hours.*.required' => 'The :attribute field is required.',
            'hours.*.numeric' => 'The :attribute must be a number.',
            'hours.*.min' => 'Please input valid hours',
        ]);
        try {
            if (auth()->user()->role != 'employee') {
                return redirect()->back()->with('error', 'Only Emlpoyee can create report');
            }
            $user = auth()->user();
            // Create a new TimeReport instance
            $timeReport = TimeReport::where('start_day', $request->start_day)
                ->where('end_day', $request->end_day)
                ->where('user_id', $user->id)
                ->first();

            if ($timeReport) {
                if ($timeReport->status == 'approve' || $timeReport->status == 'decline') {
                    return redirect()->back()->with('error', 'This week report already submitted');
                }
            }

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
            if ($request->file('image')) {
                // Handle image upload
                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('reports_images'), $imageName);

                if ($timeReport) {
                    if ($timeReport->status == 'pending') {
                        // Update the existing report
                        $timeReport->image = 'reports_images/'.$imageName;
                        $timeReport->comment = $request->comment;
                        $timeReport->save();
                    } else {
                        return redirect()->back()->with('error', 'This week report already submitted');
                    }
                } else {
                    // Create a new TimeReport instance
                    $timeReport = new TimeReport;
                    $timeReport->image = 'reports_images/'.$imageName;
                    $timeReport->user_id = auth('web')->user()->id;
                    $timeReport->employer_id = auth('web')->user()->employee->employer_id;
                    $timeReport->employee_id = auth('web')->user()->employee->id;
                    $timeReport->comment = $request->comment;
                    $timeReport->start_day = $request->start_day;
                    $timeReport->end_day = $request->end_day;
                    $timeReport->save();
                }

                $employer = Employer::findOrFail(auth('web')->user()->employee->employer_id);
                Notificattion::create([
                    'message' => auth('web')->user()->username.' Create a new report',
                    'from' => auth('web')->user()->id,
                    'to' => $employer->user->id,
                ]);
            }else{
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

    public function submitTimesheet(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,webp',
        ]);

        try {
            $request->validate([
                'hours.*' => 'required|numeric|min:0', // Validate each day's hours separately
            ], [
                'hours.*.required' => 'The :attribute field is required.',
                'hours.*.numeric' => 'The :attribute must be a number.',
                'hours.*.min' => 'The :attribute must be at least :min.',
            ]);

            if (auth()->user()->role != 'employee') {
                return redirect()->back()->with('error', 'Only Emlpoyee can create report');
            }
            $user = auth()->user();
            // Create a new TimeReport instance
            $timeReport = TimeReport::where('start_day', $request->start_day)
                ->where('end_day', $request->end_day)
                ->where('user_id', $user->id)
                ->first();

            if ($timeReport) {
                if ($timeReport) {
                    return redirect()->back()->with('error', 'This week report already submitted');
                }
            }

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

            if ($request->file('image')) {
                // Handle image upload
                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('reports_images'), $imageName);

                if ($timeReport) {
                    if ($timeReport->status == 'pending') {
                        // Update the existing report
                        $timeReport->image = 'reports_images/'.$imageName;
                        $timeReport->comment = $request->comment;
                        $timeReport->save();
                    } else {
                        return redirect()->back()->with('error', 'This week report already submitted');
                    }
                } else {
                    // Create a new TimeReport instance
                    $timeReport = new TimeReport;
                    $timeReport->image = 'reports_images/'.$imageName;
                    $timeReport->user_id = auth('web')->user()->id;
                    $timeReport->employer_id = auth('web')->user()->employee->employer_id;
                    $timeReport->employee_id = auth('web')->user()->employee->id;
                    $timeReport->comment = $request->comment;
                    $timeReport->start_day = $request->start_day;
                    $timeReport->end_day = $request->end_day;
                    $timeReport->save();
                }

                $employer = Employer::findOrFail(auth('web')->user()->employee->employer_id);
                $name = auth('web')->user()->username;
                $email = auth('web')->user()->email;
                if ($employer->user->email) {
                    // Retrieve the email template from the database
                    $emailTemplate = DB::table('email_templates')
                        ->where('type', 'timesheet_submission')
                        ->first();

                    if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                        // Replace placeholders with dynamic content
                        $formattedBody = getFormattedTextByType('timesheet_submission', [
                            'app_name' => config('app.name'),
                            'name' => auth('web')->user()->name,
                            'year' => date('Y'),
                            'link' => url('/reports'),

                        ]);

                        // Send email using Mailable class
                        Mail::to($employer->user->email)->send(new TimesheetReportMail($emailTemplate->subject, $formattedBody));
                    } else {
                        return redirect()->back()->with('error', 'Email template not found or is missing required fields.');
                    }
                }
                // notification
                Notificattion::create([
                    'message' => auth('web')->user()->username.' Create a new report',
                    'from' => auth('web')->user()->id,
                    'to' => $employer->user->id,
                ]);
            }

            return redirect()->back()->with('success', 'Report added successfully');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Error: '.$e->getMessage());
        }
    }
}
