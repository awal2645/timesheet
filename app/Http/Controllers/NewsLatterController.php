<?php

namespace App\Http\Controllers;

use App\Models\NewsLatter;
use Illuminate\Http\Request;

/**
 * Controller for managing newsletter subscriptions
 * Handles subscription creation, listing, and deletion
 */
class NewsLatterController extends Controller
{
    /**
     * Display a paginated list of newsletter subscribers
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve subscribers with pagination (10 per page)
        $newsLatters = NewsLatter::paginate(10);
        return view('newsletter.index', compact('newsLatters'));
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
        // Validate email and check for uniqueness
        $request->validate([
            'email' => 'required|email|unique:news_latters,email',
        ]);

        // Create new subscription record
        NewsLatter::create([
            'email' => $request->email,
        ]);

        // Redirect back with success message
        return redirect()
            ->back()
            ->with('success', 'You have been subscribed to our newsletter');
    }

    /**
     * Remove a newsletter subscription
     * 
     * @param int $id Subscription ID to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find and delete the subscription
        NewsLatter::find($id)->delete();

        // Redirect back with success message
        return redirect()
            ->back()
            ->with('success', 'Newsletter deleted successfully');
    }
}
