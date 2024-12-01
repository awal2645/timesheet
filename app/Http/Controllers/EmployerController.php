<?php

namespace App\Http\Controllers;

use App\Mail\EmployerInviteMail;
use App\Models\Earning;
use App\Models\Employer;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Employer view', ['only' => ['index']]);
        $this->middleware('role_or_permission:Employer create', ['only' => ['create']]);
        $this->middleware('role_or_permission:Employer update', ['only' => ['update']]);
        $this->middleware('role_or_permission:Employer destroy', ['only' => ['destroy']]);
        $this->middleware('access_limitation', ['only' => ['destroy']]);
        $this->middleware('access_limitation', ['only' => ['update']]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch the search query from the request
        $search = $request->input('search');

        // Build the query for employers
        $employers = Employer::query()
            // Apply search filters if a search term is provided
            ->when($search, function ($query, $search) {
                $query->where('employer_name', 'like', "%{$search}%")
                    ->orWhere('fein_number', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('website', 'like', "%{$search}%")
                    ->orWhere('contact_person_name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('employer.index', compact('employers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNotIn('id', [1, 3])->get();

        return view('employer.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'employer_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'fein_number' => 'required',
            'phone' => 'required|string|max:255',
            'contact_person_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|url|max:255',
            'address' => 'required|string|max:255',
            'address1' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
        ]);

        try {
            $input['role'] = 'employer';
            $input['email'] = $request->email;
            $user = User::create($input);
            if ($request->role_name) {
                $user->assignRole([$request->role_name]);
            } else {
                $user->assignRole(['employer']);
            }

            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            if ($input['email']) {
                // Send the invite email
                if ($input['email']) {
                    // Fetch the email template from the database
                    $emailTemplate = DB::table('email_templates')
                        ->where('type', 'employer_invite')
                        ->first();

                    if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                        // Replace placeholders with dynamic content
                        $formattedBody = getFormattedTextByType('employer_invite', [
                            'app_name' => config('app.name'),
                            'verify_link' => url('verify', $token),
                            'year' => date('Y'),
                        ]);

                        // Send email using Mailable class
                        Mail::to($input['email'])->send(new EmployerInviteMail($emailTemplate->subject, $formattedBody));
                    } else {
                        return redirect()->back()->with('error', 'Email template not found or is missing required fields.');
                    }
                }
            }

            $success['token'] = $user->createToken('timesheet')->plainTextToken;
            $success['name'] = $user->name;

            $employee = Employer::create([
                'user_id' => $user->id,
                'employer_name' => $request->input('employer_name'),
                'fein_number' => $request->input('fein_number'),
                'phone' => $request->input('phone'),
                'contact_person_name' => $request->input('contact_person_name'),
                'website' => $request->input('website'),
                'address' => $request->input('address'),
                'address1' => $request->input('address1'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
                'zip' => $request->input('zip'),
            ]);

            // Redirect to the desired page after successful submission
            return redirect()->route('employer.index')->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()->back()->withInput($request->all())->with(['error' => 'An error occurred while creating the employer. Please try again later.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $employee = Employer::findOrFail($id);
        $roles = Role::whereNotIn('id', [1, 3])->get();
        $modelHasRoles = DB::table('model_has_roles')->where('model_id', $employee->user->id)->pluck('role_id');

        return view('employer.edit', compact('employee', 'modelHasRoles', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $employer = Employer::findOrFail($id);
        $user = User::findOrFail($employer->user_id);

        $request->validate([
            'employer_name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,$user->id",
            'fein_number' => 'required',
            'phone' => 'required|string|max:255',
            'contact_person_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|url|max:255',
            'address' => 'required|string|max:255',
            'address1' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'role_name' => 'required',
            'account_details' => 'nullable|string',
        ]);

        try {

            if ($request->role_name) {
                DB::table('model_has_roles')->where('model_id', $employer->user->id)->delete();
                $user->assignRole([$request->role_name]);
            }

            if ($request->hasFile('image')) {
                $user = User::findOrFail(auth('web')->user()->id);
                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('user'), $imageName);
                $user->image = 'user/'.$imageName;
                $user->email = $request->email;
                $user->save();
            }

            $user->email = $request->email;
            $user->save();

            $employer->update($request->except('image', 'email', 'role_name'));

            Artisan::call('permission:cache-reset');

            return redirect()->back()->with('success', 'Updated successfully');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()->back()->withInput($request->all())->with(['error' => 'An error occurred while updating the employer details. Please try again later.']);
        }
    }

    public function destroy($id)
    {
        // Find the employee
        $employer = Employer::findOrFail($id);
    
    
        // Then delete the employee
        $employer->delete();
    
            // Find the associated user based on the employee's 'user_id' field
            $user = User::findOrFail($employer->user_id);
    
            // Delete the user first
            $user->delete();
        
        return Redirect::route('employer.index')->with('success', 'Employee and associated user deleted successfully');
    }
    

    public function updateStatus(Request $request, $id)
    {
        try {
            // Your logic to update status goes here
            $employer = Employer::findOrFail($id);

            // Update employee
            $employer->update(['status' => $request->status]);
            // Determine color based on the updated status

            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function plan()
    {

        try {
            abort_if(auth()->user()->role != 'employer', 403);
            $authUser = Auth::user();
            $userplan = UserPlan::where('employer_id', $authUser->employer->id)->first();
            $transactions = Earning::with('plan:id,label')->where('employer_id', $authUser->employer->id)
                ->latest()
                ->paginate(6);

            return view('employer.plan', compact('userplan', 'transactions'));
        } catch (\Exception $e) {

            return back();
        }
    }
}
