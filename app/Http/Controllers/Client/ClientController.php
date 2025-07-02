<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Client;
use App\Models\Employer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ClientInviteMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Client view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Client create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Client update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Client destroy', ['only' => ['destroy']]);
        $this->middleware('access_limitation', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        try {
            // Validate filter parameters
            $request->validate([
                'search' => 'nullable|string|max:255',
                'status' => 'nullable|in:0,1',
                'min_projects' => 'nullable|integer|min:0',
                'max_projects' => 'nullable|integer|min:0',
                'min_tasks' => 'nullable|integer|min:0',
                'max_tasks' => 'nullable|integer|min:0',
            ]);

            // Start with base query
            $query = Client::query();

            // Filter clients by employer if user is an employer
            if (auth('web')->user()->role == 'employer') {
                $query->where('employer_id', auth('web')->user()->employer->id);
            }

            // Apply search filter if provided
            if ($request->filled('search')) {
                $searchTerm = trim($request->input('search'));
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('client_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('client_email', 'like', '%' . $searchTerm . '%')
                      ->orWhere('contact_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('client_phone', 'like', '%' . $searchTerm . '%');
                });
            }

            // Apply status filter if provided
            if ($request->filled('status')) {
                $query->where('status', $request->input('status'));
            }

            // Apply project range filters if provided
            if ($request->filled('min_projects')) {
                $query->whereHas('projects', function ($projectQuery) use ($request) {
                    $projectQuery->havingRaw('COUNT(*) >= ?', [$request->input('min_projects')]);
                });
            }

            if ($request->filled('max_projects')) {
                $query->whereHas('projects', function ($projectQuery) use ($request) {
                    $projectQuery->havingRaw('COUNT(*) <= ?', [$request->input('max_projects')]);
                });
            }

            // Apply task range filters if provided
            if ($request->filled('min_tasks')) {
                $query->whereHas('tasks', function ($taskQuery) use ($request) {
                    $taskQuery->havingRaw('COUNT(*) >= ?', [$request->input('min_tasks')]);
                });
            }

            if ($request->filled('max_tasks')) {
                $query->whereHas('tasks', function ($taskQuery) use ($request) {
                    $taskQuery->havingRaw('COUNT(*) <= ?', [$request->input('max_tasks')]);
                });
            }

            // Get paginated results with query parameters preserved
            $clients = $query->latest()->paginate(10)->appends($request->query());

            // Log successful filtering
            \Illuminate\Support\Facades\Log::info('Client index accessed', [
                'user_id' => auth()->id(),
                'filters' => $request->only(['search', 'status', 'min_projects', 'max_projects', 'min_tasks', 'max_tasks']),
                'results_count' => count($clients->items()),
                'total_count' => $clients->total()
            ]);

            // Fetch all employers for potential use
            $employers = Employer::all();

            return view('client.index', compact('clients', 'employers'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Invalid filter parameters provided.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in client index', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while loading clients. Please try again.');
        }
    }

    public function create()
    {
        try {
            $employers = Employer::all();

            return view('client.create', compact('employers'));
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->route('client.index')
                ->with('error', 'An error occurred while fetching employers: '.$e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|unique:clients|max:255',
            'contact_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
        ]);

        try {

            // Create new user
            $input['role'] = 'client';
            $input['email'] = $request->client_email;
            $user = User::create($input);
            $user->assignRole(['client']);

            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->client_email,
                'token' => $token,
                'created_at' => now(),
            ]);

            if ($input['email']) {
                $emailTemplate = DB::table('email_templates')
                    ->where('type', 'client_invite')
                    ->first();
            }   

            if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                $formattedBody = getFormattedTextByType('client_invite', [
                    'app_name' => config('app.name'),
                    'verify_link' => route('email.verify', $token),
                    'year' => date('Y'),
                ]);
            }   

            if (checkMailConfig()) {
                Mail::to($input['email'])->send(new ClientInviteMail($emailTemplate->subject, $formattedBody));
            }
            

            $client = Client::create([
                'user_id' => $user->id,
                'employer_id' => $request->employer_id,
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'contact_name' => $request->contact_name,
                'client_phone' => $request->client_phone,
            ]);
            
            // Redirect to the client's details page or any other appropriate route
            return redirect()->route('client.index')->with('success', 'Client created successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occurred while creating client: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $client = Client::findOrFail($id);
            $employers = Employer::all();

            return view('client.edit', compact('client', 'employers'));
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->route('client.index')
                ->with('error', 'An error occurred while editing client: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|unique:clients,id',
            'contact_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:15',
        ]);
        try {
            $client = Client::findOrFail($id);
            $user = User::findOrFail($client->user_id);
            $user->update([
                'name' => $request->client_name,
                'email' => $request->client_email,
            ]);
            $client->update([
                'employer_id' => $request->employer_id,
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'contact_name' => $request->contact_name,
                'client_phone' => $request->client_phone,
            ]);

            return redirect()->route('client.index')->with('success', 'Client updated successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->route('client.index')
                ->with('error', 'An error occurred while updating client: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();

            return redirect()->route('client.index')->with('success', 'Client deleted successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->route('client.index')
                ->with('error', 'An error occurred while deleting client: '.$e->getMessage());
        }
    }

    /**
     * Update client status
     * 
     * @param Request $request Contains status update
     * @param int $id Client ID
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'status' => 'required|in:0,1'
            ]);

            $client = Client::findOrFail($id);
            
            // Check if user has permission to update this client
            if (auth('web')->user()->role == 'employer') {
                // Employers can only update clients under their organization
                if ($client->employer_id !== auth('web')->user()->employer->id) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
                    }
                    return redirect()->back()->with('error', 'Unauthorized to update this client status.');
                }
            }

            // Update the status
            $client->update(['status' => $request->status]);

            // Log the status change
            \Illuminate\Support\Facades\Log::info('Client status updated', [
                'client_id' => $client->id,
                'client_name' => $client->client_name,
                'old_status' => $client->getOriginal('status'),
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
            
            return redirect()->back()->with('success', 'Client status updated successfully');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => 'Invalid status value'], 422);
            }
            return redirect()->back()->with('error', 'Invalid status value provided.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Illuminate\Support\Facades\Log::warning('Client not found for status update', [
                'client_id' => $id,
                'user_id' => auth()->id()
            ]);
            
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => 'Client not found'], 404);
            }
            return redirect()->back()->with('error', 'Client not found.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating client status', [
                'client_id' => $id,
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => 'An error occurred while updating status'], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while updating client status.');
        }
    }

    public function employerClient($employer)
    {
        try {
            $employer = Employer::where('employer_name', $employer)->value('id');
            $clients = Client::where('employer_id', $employer)->paginate(10);

            $employers = Employer::all();

            return view('client.index', compact('clients', 'employers'));
        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return redirect()
                ->route('home')
                ->with('error', 'An error occurred while fetching clients: '.$e->getMessage());
        }
    }

    public function getClientsByEmployer($employerId)
    {
        try {
            $clients = Client::where('employer_id', $employerId)
                           ->where('status', true)
                           ->get(['id', 'client_name']);
            return response()->json($clients);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch clients'], 500);
        }
    }

    public function ajaxSearch(Request $request)
    {
        $search = $request->input('q');
        $results = \App\Models\Client::where('client_name', 'like', "%$search%")
            ->select('id', 'client_name as text')
            ->limit(5)
            ->get();
        return response()->json(['results' => $results]);
    }
}
