<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $testimonials = Testimonial::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('designation', 'like', "%{$search}%")
                         ->orWhere('company', 'like', "%{$search}%");
        })->paginate(10);

        return view('testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->move(public_path('/images/testimonial'), 'images/testimonial/'.$request->name.'.png'); 
            $path = 'images/testimonial/'.$request->name.'.png';
        }

        Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'company' => $request->company,
            'description' => $request->description,
            'rating' => $request->rating,
            'image' => $path,
        ]);

        return redirect()->route('testimonial.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->move(public_path('/images/testimonial'), 'images/testimonial/'.$request->name.'.png'); 
            $path = 'images/testimonial/'.$request->name.'.png';
        }
        

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->company = $request->company;
        $testimonial->description = $request->description;
        $testimonial->rating = $request->rating;
        $testimonial->image = $path;
        $testimonial->save();

        return redirect()->route('testimonial.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonial.index')->with('success', 'Testimonial deleted successfully.');
    }
}