<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employer;
use Illuminate\Http\Request;

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
            // Get search parameters
            $search = $request->input('search');
            $status = $request->input('status');

            // Check if the user is an employer and filter clients accordingly
            if (auth('web')->user()->role == 'employer') {
                // Filter clients for the specific employer
                $clients = Client::where('employer_id', auth('web')->user()->employer->id);

                // Apply search filter if search term is present
                if ($search) {
                    $clients = $clients->where(function ($query) use ($search) {
                        $query->where('client_name', 'like', "%{$search}%")
                            ->orWhere('client_email', 'like', "%{$search}%")
                            ->orWhere('contact_name', 'like', "%{$search}%")
                            ->orWhere('client_phone', 'like', "%{$search}%");
                    });
                }

                // Apply status filter if status is passed
                if ($status !== null) {
                    $clients = $clients->where('status', $status);
                }

                // Paginate the filtered clients
                $clients = $clients->paginate(10);

            } else {
                // If user is not an employer, show all clients
                $clients = Client::latest();

                // Apply search filter
                if ($search) {
                    $clients = $clients->where(function ($query) use ($search) {
                        $query->where('client_name', 'like', "%{$search}%")
                            ->orWhere('client_email', 'like', "%{$search}%")
                            ->orWhere('contact_name', 'like', "%{$search}%")
                            ->orWhere('client_phone', 'like', "%{$search}%");
                    });
                }

                // Apply status filter
                if ($status !== null) {
                    $clients = $clients->where('status', $status);
                }

                // Paginate the filtered clients
                $clients = $clients->paginate(10);
            }

            // Fetch all employers
            $employers = Employer::all();

            // Return the view with the filtered clients and employers
            return view('client.index', compact('clients', 'employers'));

        } catch (\Exception $e) {
            // Handle exception and redirect with error message
            return redirect()
                ->route('home')
                ->with('error', 'An error occurred while fetching clients: '.$e->getMessage());
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
            $client = Client::create($request->all());

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
            $client->update($request->all());

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

    public function updateStatus(Request $request, $id)
    {
        try {
            // Your logic to update status goes here
            $client = Client::findOrFail($id);

            // Update employee
            $client->update(['status' => $client->status == '1' ? '0' : '1']);
            // Determine color based on the updated status

            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
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
}
