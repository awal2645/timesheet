<?php

namespace App\Http\Controllers;

use App\Mail\TimesheetStatusUpdateMail;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Notificattion;
use App\Models\TimeReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TimeReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Report view', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        // try {
            // Get search parameters
            $search = $request->input('search');
            $status = $request->input('status');
    
            // Check the user's role and filter time reports accordingly
            if (auth('web')->user()->role == 'employer') {
                $timeReports = TimeReport::where('employer_id', auth('web')->user()->employer->id);
            } elseif (auth('web')->user()->role == 'employee') {
                $timeReports = TimeReport::where('user_id', auth('web')->user()->id);
            } else {
                $timeReports = TimeReport::query();
            }
    
            // Apply search filter if a search term is present
            if ($search) {
                $timeReports = $timeReports->whereHas('user', function ($query) use ($search) {
                    $query->where('username', 'like', "%{$search}%"); // Search by user's name
                });
            }
    
    
            // Apply status filter if it's present
            if ($status !== null) {
                $timeReports = $timeReports->where('status', $status);
            }
    
            // Fetch the filtered time reports
            $timeReports = $timeReports->paginate(10);
    
            // Get the day reports as before
            $timedayReports = TimeReport::select('start_day', 'end_day')->get();
    
            // Return the view with the filtered time reports and day reports
            return view('reports.index', compact('timeReports', 'timedayReports'));
    
        // } catch (\Exception $e) {
        //     // Handle any errors and redirect back with an error message
        //     return redirect()
        //         ->back()
        //         ->with(['error' => 'An error occurred while loading the reports. Please try again later.']);
        // }
    }
    

    public function updateStatus(Request $request, $id)
    {
        try {
            // Your logic to update status goes here
            $report = TimeReport::findOrFail($id);
            // Update employee
            $report->update(['status' => $request->status]);
            // Determine color based on the updated status
            $employee = User::findOrFail($report->user_id);

            if ($employee) {
                // Retrieve the email template from the database
                $emailTemplate = DB::table('email_templates')
                    ->where('type', 'timesheet_update')
                    ->first();

                if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                    // Replace placeholders with dynamic content
                    $formattedBody = getFormattedTextByType('timesheet_update', [
                        'app_name' => config('app.name'),
                        'status' => $request->status,
                        'year' => date('Y'),
                    ]);

                    // Send email using Mailable class
                    Mail::to($employee->email)->send(new TimesheetStatusUpdateMail($emailTemplate->subject, $formattedBody));
                } else {
                    return redirect()->back()->with('error', 'Email template not found or is missing required fields.');
                }

            }
            // notification
            Notificattion::create([
                'message' => auth('web')->user()->username.' Report Status update',
                'from' => auth('web')->user()->id,
                'to' => $employee->id,
            ]);

            return redirect()
                ->back()
                ->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred while fetching clients: '.$e->getMessage());
        }
    }

    public function feedback(Request $request, $id)
    {
        try {
            // Your logic to update status goes here
            $report = TimeReport::findOrFail($id);
            // Update employee
            $report->update(['feedback' => $request->feedback]);
            // Determine color based on the updated status
            $employee = User::findOrFail($report->user_id);

            if ($employee) {
                Mail::send('mails.status', ['status' => $request->status], function ($message) use ($employee) {
                    $message->to($employee->email);
                    $message->subject('TimeSheet Status');
                });
            }
            //  notification
            Notificattion::create([
                'message' => auth('web')->user()->username.' Send a feedback update',
                'from' => auth('web')->user()->id,
                'to' => $employee->id,
            ]);

            return redirect()
                ->back()
                ->with('success', 'Feedback submitted successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred while fetching clients: '.$e->getMessage());
        }
    }

    public function employerReport($employer)
    {
        try {
            $employer = Employer::where('employer_name', $employer)->value('id');
            $timeReports = TimeReport::where('employer_id', $employer)->paginate(10);

            $employees = Employee::all();

            $employers = Employer::all();
            $timedayReports = TimeReport::select('start_day', 'end_day')->get();

            return view('reports.index', compact('timeReports', 'employers', 'employees', 'timedayReports'));
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->back()
                ->with('error', 'An error occurred while fetching clients: '.$e->getMessage());
        }

    }

    public function employeeReport($employee)
    {
        try {
            $employee = Employee::where('employee_name', $employee)->value('id');
            if (auth('web')->user()->role == 'employer') {
                $timeReports = TimeReport::where('employer_id', auth('web')->user()->employer->id)->get();
                $employees = Employee::where('employer_id', auth('web')->user()->employer->id)->paginate(10);
            } else {
                $timeReports = TimeReport::where('employee_id', $employee)->paginate(10);
                $employees = Employee::all();
            }

            $employers = Employer::all();
            $timedayReports = TimeReport::select('start_day', 'end_day')->paginate(10);

            return view('reports.index', compact('timeReports', 'employers', 'employees', 'timedayReports'));
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->back()
                ->with('error', 'An error occurred while fetching clients: '.$e->getMessage());
        }

    }

    public function dateReport()
    {
        try {
            if (auth('web')->user()->role == 'employer') {
                $timeReports = TimeReport::where('employer_id', auth('web')->user()->employer->id)->where('start_day', request('start_day'))->where('end_day', request('end_day'))->paginate(10);
                $employees = Employee::where('employer_id', auth('web')->user()->employer->id)->get();
            } else {
                $timeReports = TimeReport::where('start_day', request('start_day'))->where('end_day', request('end_day'))->paginate(10);
                $employees = Employee::all();
            }

            $employers = Employer::all();
            $timedayReports = TimeReport::select('start_day', 'end_day')->paginate(10);

            return view('reports.index', compact('timeReports', 'employers', 'employees', 'timedayReports'));
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->back()
                ->with('error', 'An error occurred while fetching clients: '.$e->getMessage());
        }
    }
}
