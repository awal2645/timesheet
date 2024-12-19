<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Timesheet;
use Illuminate\Http\Request;

class EmployeeSalryController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'employer') {
            $employees = Employee::where('employer_id', auth()->user()->employer->id)->get();
            return view('employee.salary.employer.index', compact('employees'));

        }else{
            $employer = Employer::all();
            $employees = Employee::all();
            return view('employee.salary.index', compact('employees', 'employer'));

        }
    }

    public function show(Request $request)
    {
        $employee = Employee::find($request->employee);
        $timesheets = Timesheet::where('user_id', $employee->user_id)->get();
        $employee_total_hours = $timesheets->sum('hours');
        if($employee->payment_type == 'project'){
            $employee_total_salary = $employee_total_hours * $employee->billing_rate;
        }else{
            $employee_total_salary = $employee->monthly_salary;
        }
        
        return view('employee.salary.show', compact('employee', 'timesheets', 'employee_total_hours', 'employee_total_salary'));
    }

    public function download($id)
    {

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

     
        $employee = Employee::find($id);
        $timesheets = Timesheet::where('user_id', $employee->user_id)->get();
        $employee_total_hours = $timesheets->sum('hours');
        if($employee->payment_type == 'project'){
            $employee_total_salary = $employee_total_hours * $employee->billing_rate;
        }else{
            $employee_total_salary = $employee->monthly_salary;
        }

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
