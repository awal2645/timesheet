<?php

namespace Modules\Newsletter\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Newsletter\App\Models\Newsletter;
use Illuminate\Support\Facades\Config;

class NewsletterController extends Controller
{
    /**
     * Display a paginated list of newsletter subscribers
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newsletters = Newsletter::paginate( 10);
        return view('newsletter::index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newsletter::create');
    }

    /**
     * Store a new newsletter subscription
     * Validates email and ensures no duplicate subscriptions
     * 
     * @param Request $request Contains subscriber email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => Config::get('newsletter.email_validation.rules'),
        ], Config::get('newsletter.email_validation.messages'));

        Newsletter::create([
            'email' => $request->email,
        ]);

        return redirect()
            ->back()
            ->with('success', 'You have been subscribed to our newsletter');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('newsletter::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('newsletter::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove a newsletter subscription
     * 
     * @param int $id Subscription ID to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Newsletter::find($id)->delete();

        return redirect()
            ->back()
            ->with('success', 'Newsletter deleted successfully');
    }
}
