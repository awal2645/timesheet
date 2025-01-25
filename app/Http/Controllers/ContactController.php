<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Notificattion;

/**
 * Controller for handling contact form submissions and management
 */
class ContactController extends Controller
{
    /**
     * Display a paginated list of contact form submissions
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve contacts with pagination (10 items per page)
        $contacts = Contact::paginate(10);
        return view('contact.index', compact('contacts'));
    }

    /**
     * Store a new contact form submission
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required',
            'message' => 'required',
        ]);

        // Create new contact record with all request data
        Contact::create($request->all());

        // Create notification for admin (user ID: 1)
        Notificattion::create([
            'message' => $request->name.' Contact form submitted',
            'to' => 1,
            'page_url' => '/contact',
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Contact form submitted successfully');
    }

    /**
     * Delete a contact form submission
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find and delete the contact record
        Contact::find($id)->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
}
