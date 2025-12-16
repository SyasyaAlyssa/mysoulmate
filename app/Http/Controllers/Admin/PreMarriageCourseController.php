<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreMarriageCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- ADD THIS LINE

class PreMarriageCourseController extends Controller
{
    public function index()
    {
        $courses = PreMarriageCourse::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $course = new PreMarriageCourse();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->is_published = $request->has('is_published');


        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            // --- FIX APPLIED HERE ---
            // 1. Use Storage::disk('public') to ensure the file is saved to storage/app/public 
            // 2. We are saving it into a subfolder named 'courses'
            $path = $file->storeAs('courses', time() . '_' . $file->getClientOriginalName(), 'public');
            
            // The $path returned is 'courses/16788888_imagename.jpg', which is exactly what we need.
            $course->image = $path;
        }

        $course->save();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course uploaded successfully!');
    }
public function destroy($id)
{
    $course = PreMarriageCourse::findOrFail($id);

    // Delete image file from public folder
    if ($course->image) {
    Storage::disk('public')->delete($course->image);
}

    // Delete the database record
    $course->delete();

    return redirect()->route('admin.courses.index')
        ->with('success', 'Course deleted successfully!');
}
public function edit(PreMarriageCourse $course)
{
    return view('admin.courses.edit', compact('course'));
}

public function update(Request $request, PreMarriageCourse $course)
{
    $request->validate([
        'title' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $course->title = $request->title;
    $course->description = $request->description;
    $course->is_published = $request->has('is_published');


    // Replace image if new one uploaded
    if ($request->hasFile('image')) {

        // delete old image
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $path = $request->file('image')
            ->storeAs('courses', time().'_'.$request->file('image')->getClientOriginalName(), 'public');

        $course->image = $path;
    }

    $course->save();

    return redirect()->route('admin.courses.index')
        ->with('success', 'Course updated successfully!');
}
public function togglePublish(\App\Models\PreMarriageCourse $course)
{
    $course->is_published = ! $course->is_published;
    $course->save();

    return back()->with('success', 'Course visibility updated.');
}
public function toggle($id)
{
    $course = PreMarriageCourse::findOrFail($id);
    $course->is_published = !$course->is_published;
    $course->save();

    return back()->with('success', 'Course status updated');
}



}