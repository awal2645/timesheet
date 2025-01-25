<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

/**
 * Controller for managing testimonials
 * Handles CRUD operations for customer testimonials and reviews
 */
class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials with search functionality
     * 
     * @param Request $request Contains search parameters
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get search term from request
        $search = $request->get('search');
        
        // Query testimonials with optional search filter
        $testimonials = Testimonial::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('designation', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%");
        })->paginate(10);

        return view('testimonial.index', compact('testimonials'));
    }

    /**
     * Show form for creating a new testimonial
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('testimonial.create');
    }

    /**
     * Store a newly created testimonial
     * Handles image upload and data validation
     * 
     * @param Request $request Contains testimonial data and image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate testimonial data
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $request->file('image')->move(
                public_path('/images/testimonial'), 
                'images/testimonial/'.$request->name.'.png'
            ); 
            $path = 'images/testimonial/'.$request->name.'.png';
        }

        // Create new testimonial
        Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'company' => $request->company,
            'description' => $request->description,
            'rating' => $request->rating,
            'image' => $path,
        ]);

        return redirect()
            ->route('testimonial.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show form for editing a testimonial
     * 
     * @param Testimonial $testimonial Testimonial to edit
     * @return \Illuminate\View\View
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonial.edit', compact('testimonial'));
    }

    /**
     * Update an existing testimonial
     * Handles image update and data validation
     * 
     * @param Request $request Contains updated testimonial data
     * @param Testimonial $testimonial Testimonial to update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        // Validate updated testimonial data
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);

        // Handle image update if new image provided
        if ($request->hasFile('image')) {
            $request->file('image')->move(
                public_path('/images/testimonial'), 
                'images/testimonial/'.$request->name.'.png'
            ); 
            $path = 'images/testimonial/'.$request->name.'.png';
        }

        // Update testimonial data
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->company = $request->company;
        $testimonial->description = $request->description;
        $testimonial->rating = $request->rating;
        $testimonial->image = $path;
        $testimonial->save();

        return redirect()
            ->route('testimonial.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove a testimonial
     * 
     * @param Testimonial $testimonial Testimonial to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        
        return redirect()
            ->route('testimonial.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}