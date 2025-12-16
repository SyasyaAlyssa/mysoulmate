<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        return view('student.edit-profile'); // Blade file for editing profile
    }

    /**
     * Update the user's profile details.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'kulliyyah' => 'nullable|string|max:255',
            'study_level' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'hobby' => 'nullable|string|max:255',
            'looking_for' => 'nullable|string|max:255',
            'about_me' => 'nullable|string|max:1000',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'kulliyyah' => $request->kulliyyah,
            'study_level' => $request->study_level,
            'nationality' => $request->nationality,
            'hobby' => $request->hobby,
            'looking_for' => $request->looking_for,
            'about_me' => $request->about_me,
        ]);

         return redirect()->route('student.dashboard')->with('success', 'Profile updated successfully!');
    }

    /**
     * Upload or update the user's profile photo.
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // Delete old photo if exists
            if ($user->profile_photo && Storage::disk('public')->exists('profile/' . $user->profile_photo)) {
    Storage::disk('public')->delete('profile/' . $user->profile_photo);
}


            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile', $filename);

            $user->profile_photo = $filename;
            $user->save();
        }

        return back()->with('success', 'Profile photo uploaded!');
    }

    /**
     * Display the user's profile page.
     */
    public function show()
    {
        return view('student.edit-profile'); // Blade file for profile view
    }
}
