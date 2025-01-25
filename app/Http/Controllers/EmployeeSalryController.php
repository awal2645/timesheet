<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Timesheet;
use Illuminate\Http\Request;

/**
 * Controller for managing employee salary operations and reports
 */
class EmployeeSalryController extends Controller
{
    /**
     * Display salary information based on user role
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->role === 'employer') {
            // For employers: show only their employees
            $employees = Employee::where('employer_id', auth()->user()->employer->id)->get();
            return view('employee.salary.employer.index', compact('employees'));
        } else {
            // For admins: show all employers and employees
            $employer = Employer::all();
            $employees = Employee::all();
            return view('employee.salary.index', compact('employees', 'employer'));
        }
    }

    /**
     * Show detailed salary information for a specific employee
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        // Find employee and their timesheets
        $employee = Employee::find($request->employee);
        $timesheets = Timesheet::where('user_id', $employee->user_id)->get();
        
        // Calculate total hours worked
        $employee_total_hours = $timesheets->sum('hours');
        
        // Calculate total salary based on payment type
        if($employee->payment_type == 'project'){
            // Project-based: hourly rate × total hours
            $employee_total_salary = $employee_total_hours * $employee->billing_rate;
        } else {
            // Fixed monthly salary
            $employee_total_salary = $employee->monthly_salary;
        }
        
        return view('employee.salary.show', compact(
            'employee', 
            'timesheets', 
            'employee_total_hours', 
            'employee_total_salary'
        ));
    }

    /**
     * Generate and download PDF salary invoice
     * @param int $id Employee ID
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        // Configure PDF options for proper rendering
        $options = [
            'defaultFont' => 'DejaVu Sans',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'defaultMediaType' => 'screen',
            'isFontSubsettingEnabled' => true,
            'dpi' => 150,
            'defaultPaperSize' => 'a4',
            'orientation' => 'portrait',
            'enable_css_float' => true,
            'enable_remote' => true,
        ];

        // Get employee data and calculate salary
        $employee = Employee::find($id);
        $timesheets = Timesheet::where('user_id', $employee->user_id)->get();
        $employee_total_hours = $timesheets->sum('hours');
        
        // Calculate total salary based on payment type
        if($employee->payment_type == 'project'){
            $employee_total_salary = $employee_total_hours * $employee->billing_rate;
        } else {
            $employee_total_salary = $employee->monthly_salary;
        }

        // Generate PDF with calculated data
        $pdf = PDF::setOptions($options)
                    ->loadView('employee.salary.invoice', [
                        'employee' => $employee,
                        'employee_total_hours' => $employee_total_hours,
                        'employee_total_salary' => $employee_total_salary,
                        'isPdf' => true
                    ]);
        
        return $pdf->download('employee_salary_invoice.pdf');
    }
}
