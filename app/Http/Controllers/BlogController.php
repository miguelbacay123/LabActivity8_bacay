<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
$blogs = Blog::all();
return view('blogs.index', compact('blogs'));
        // $blogs = Blog::orderBy('created_at', 'desc')->get();
        // return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

    if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = uniqid('img_', true) . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads'), $imageName);
    $imagePath = 'uploads/' . $imageName;
    } else {
    $imagePath = null;
    }


        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success','Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image'] = $path;
        }

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success','Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success','Blog deleted successfully.');
    }
}
