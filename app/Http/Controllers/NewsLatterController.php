<?php

namespace App\Http\Controllers;

use App\Models\NewsLatter;
use Illuminate\Http\Request;

class NewsLatterController extends Controller
{
    public function index()
    {
        $newsLatters = NewsLatter::paginate(10);
        return view('newsletter.index', compact('newsLatters'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:news_latters,email',
        ]);
        NewsLatter::create([
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'You have been subscribed to our newsletter');
    }
    public function destroy($id)
    {
        NewsLatter::find($id)->delete();
        return redirect()->back()->with('success', 'Newsletter deleted successfully');
    }
}
