<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Notificattion;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('contact.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required',
            'message' => 'required',
        ]);

        Contact::create($request->all());
        // notification
        Notificattion::create([
            'message' => $request->name.' Contact form submitted',
            'to' => 1,
            'page_url' => '/contact',
        ]);

        return redirect()->back()->with('success', 'Contact form submitted successfully');
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
}
