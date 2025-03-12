<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\EmployeeRequestHandler;
use App\Services\EmployeeService;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Client;
use Illuminate\Http\Request;

/**
 * Controller for managing employee operations
 * Handles CRUD operations for employees with role-based access control
 */
class EmployeeController extends Controller
{
    /** @var EmployeeService */
    protected $employeeService;
    
    /** @var EmployeeRequestHandler */
    protected $employeeRequestHandler;

    /**
     * Initialize controller with required dependencies and middleware
     * @param EmployeeService $employeeService Service for employee operations
     * @param EmployeeRequestHandler $employeeRequestHandler Handler for employee requests
     */
    public function __construct(EmployeeService $employeeService, EmployeeRequestHandler $employeeRequestHandler)
    {
        $this->employeeService = $employeeService;
        $this->employeeRequestHandler = $employeeRequestHandler;

        // Set up role-based access control
        $this->middleware('role_or_permission:Employee view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Employee create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Employee update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Employee destroy', ['only' => ['destroy']]);
        $this->middleware('access_limitation', ['only' => ['destroy']]);
    }

    /**
     * Display paginated list of employees with optional search
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        // Filter employees by employer if user is an employer
        if (auth('web')->user()->role == 'employer') {
            $query->where('employer_id', auth('web')->user()->employer->id);
        }

        // Apply search filters if provided
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('employee_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $searchTerm . '%');
        }

        // Get paginated results
        $employees = $query->latest()->paginate(10);
        $employers = Employer::latest()->paginate(10);

        return view('employee.index', compact('employees', 'employers'));
    }

    /**
     * Show employee creation form with relevant data
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $employers = Employer::all();
        $clients = Client::all();

        // Filter clients by employer if user is an employer
        if (auth('web')->user()->role == 'employer') {
            $clients = Client::where('employer_id', auth('web')->user()->employer->id)->get();
            return view('employee.create', compact('employers', 'clients'));
        }

        return view('employee.create', compact('employers', 'clients'));
    }

    /**
     * Store a new employee record
     * @param StoreEmployeeRequest $request Validated request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            // Create employee using service layer
            $employee = $this->employeeService->create($request->validated());
            return redirect()->route('employee.index')->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())
                ->with(['error' => 'An error occurred while processing your request: ' . $e->getMessage()]);
        }
    }

    /**
     * Show employee edit form
     * @param string $id Employee ID
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employers = Employer::all();
        $clients = Client::all();

        return view('employee.edit', compact('employee', 'employers', 'clients'));
    }

    /**
     * Update employee record
     * @param Request $request
     * @param string $id Employee ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        // Validate the request using the handler
        $data = $this->employeeRequestHandler->validateSaveRequest($request);

        try {
            $employee = Employee::findOrFail($id);
            
            // Update employee using service layer
            $this->employeeService->update($employee, $data);

            return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating employee: ' . $e->getMessage());
        }
    }

    /**
     * Update employee status
     * 
     * @param Request $request Contains status update
     * @param int $id Employee ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->update(['status' => $request->status]);
            
            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating status: ' . $e->getMessage());
        }
    }

    /**
     * Delete employee record
     * @param string $id Employee ID
     * @return \Illuminate\Http\RedirectResponse
     */
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
