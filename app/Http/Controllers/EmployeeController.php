<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\EmployeeRequestHandler;
use App\Services\EmployeeService;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * Display paginated list of employees with advanced filtering
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            // Validate filter parameters
            $request->validate([
                'search' => 'nullable|string|max:255',
                'status' => 'nullable|in:0,1',
                'min_leave' => 'nullable|integer|min:0|max:365',
                'max_leave' => 'nullable|integer|min:0|max:365',
                'employer_id' => 'nullable|exists:employers,id',
            ]);

            // Start with base query including necessary relationships
            $query = Employee::with(['user', 'employer']);

            // Filter employees by employer if user is an employer
            if (auth('web')->user()->role == 'employer') {
                $query->where('employer_id', auth('web')->user()->employer->id);
            }

            // Apply search filter if provided
            if ($request->filled('search')) {
                $searchTerm = trim($request->input('search'));
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('employee_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                          $userQuery->where('email', 'like', '%' . $searchTerm . '%');
                      });
                });
            }

            // Apply status filter if provided
            if ($request->filled('status')) {
                $query->where('status', $request->input('status'));
            }

            // Apply leave range filters if provided
            if ($request->filled('min_leave')) {
                $query->where('total_leave', '>=', $request->input('min_leave'));
            }

            if ($request->filled('max_leave')) {
                $query->where('total_leave', '<=', $request->input('max_leave'));
            }

            // Apply employer filter if provided (for admin users)
            if ($request->filled('employer_id') && auth('web')->user()->role !== 'employer') {
                $query->where('employer_id', $request->input('employer_id'));
            }

            // Get paginated results with query parameters preserved
            $employees = $query->latest()->paginate(10)->appends($request->query());

            // Log successful filtering
            Log::info('Employee index accessed', [
                'user_id' => auth()->id(),
                'filters' => $request->only(['search', 'status', 'min_leave', 'max_leave', 'employer_id']),
                'results_count' => count($employees->items()),
                'total_count' => $employees->total()
            ]);

            return view('employee.index', compact('employees'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Invalid filter parameters provided.');
        } catch (\Exception $e) {
            Log::error('Error in employee index', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while loading employees. Please try again.');
        }
    }

    /**
     * Show employee creation form with relevant data
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $employers = Employer::all();
        $clients = Client::where('status', '1')->get();

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'status' => 'required|in:0,1'
            ]);

            $employee = Employee::findOrFail($id);
            
            // Check if user has permission to update this employee
            if (auth('web')->user()->role == 'employer') {
                // Employers can only update employees under their organization
                if ($employee->employer_id !== auth('web')->user()->employer->id) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
                    }
                    return redirect()->back()->with('error', 'Unauthorized to update this employee status.');
                }
            }

            // Update the status
            $employee->update(['status' => $request->status]);

            // Log the status change
            Log::info('Employee status updated', [
                'employee_id' => $employee->id,
                'employee_name' => $employee->employee_name,
                'old_status' => $employee->getOriginal('status'),
                'new_status' => $request->status,
                'updated_by' => auth()->id()
            ]);

            // Return appropriate response based on request type
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully',
                    'new_status' => $request->status
                ]);
            }
            
            return redirect()->back()->with('success', 'Employee status updated successfully');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => 'Invalid status value'], 422);
            }
            return redirect()->back()->with('error', 'Invalid status value provided.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Employee not found for status update', [
                'employee_id' => $id,
                'user_id' => auth()->id()
            ]);
            
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => 'Employee not found'], 404);
            }
            return redirect()->back()->with('error', 'Employee not found.');
        } catch (\Exception $e) {
            Log::error('Error updating employee status', [
                'employee_id' => $id,
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => 'An error occurred while updating status'], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while updating employee status.');
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

    public function ajaxSearch(Request $request)
    {
        $search = $request->input('q');
        $employerId = $request->input('employer_id');
        
        $query = Employee::query();
        
        // Filter by employer if provided
        if ($employerId) {
            $query->where('employer_id', $employerId);
        }
        
        // Apply search if provided
        if ($search) {
            $query->where('employee_name', 'like', "%{$search}%");
        }
        
        $results = $query->select('id', 'employee_name as text')
                        ->limit(5)
                        ->get();
                        
        return response()->json(['results' => $results]);
    }
}
