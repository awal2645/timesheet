<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\EmployeeRequestHandler;
use App\Services\EmployeeService;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Client;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;
    protected $employeeRequestHandler;

    public function __construct(EmployeeService $employeeService, EmployeeRequestHandler $employeeRequestHandler)
    {
        $this->employeeService = $employeeService;
        $this->employeeRequestHandler = $employeeRequestHandler;

        $this->middleware('role_or_permission:Employee view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Employee create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Employee update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Employee destroy', ['only' => ['destroy']]);
        $this->middleware('access_limitation', ['only' => ['destroy']]);
    }

    // Index page
    public function index(Request $request)
    {
        $query = Employee::query();

        if (auth('web')->user()->role == 'employer') {
            $query->where('employer_id', auth('web')->user()->employer->id);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('employee_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $searchTerm . '%');
        }

        $employees = $query->latest()->paginate(10);
        $employers = Employer::latest()->paginate(10);

        return view('employee.index', compact('employees', 'employers'));
    }

    // Create form
    public function create()
    {
        $employers = Employer::all();
        $clients = Client::all();

        return view('employee.create', compact('employers', 'clients'));
    }

    // Store the new employee
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = $this->employeeService->create($request->validated());
            return redirect()->route('employee.index')->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())
                ->with(['error' => 'An error occurred while processing your request: ' . $e->getMessage()]);
        }
    }

    // Edit form
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employers = Employer::all();
        $clients = Client::all();

        return view('employee.edit', compact('employee', 'employers', 'clients'));
    }

    // Update the employee
    public function update(Request $request, string $id)
    {
        // Validate the request using the EmployeeRequestHandler

        $data = $this->employeeRequestHandler->validateSaveRequest($request);

        try {
            $employee = Employee::findOrFail($id);

            // Update the employee using validated data
            $this->employeeService->update($employee, $data);

            return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating employee: ' . $e->getMessage());
        }
    }

    // Delete the employee
    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $this->employeeService->delete($employee);
            return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('employee.index')->with('error', 'An error occurred while deleting employee: ' . $e->getMessage());
        }
    }
}
