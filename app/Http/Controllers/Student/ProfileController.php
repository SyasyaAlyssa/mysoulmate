<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // View profile
    public function show()
    {
        return view('student.profile');
    }

    // Edit profile
    public function edit()
    {
        return view('student.edit-profile');
    }

    // Update profile details
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'dob' => 'nullable|date',
            'kulliyyah' => 'nullable|string',
            'study_level' => 'nullable|string',
            'nationality' => 'nullable|string',
            'about_me' => 'nullable|string',
            'hobby' => 'nullable|string',
            'looking_for' => 'nullable|string',
        ]);

        Auth::user()->update($request->only([
            'name',
            'phone',
            'dob',
            'kulliyyah',
            'study_level',
            'nationality',
            'about_me',
            'hobby',
            'looking_for',
        ]));

        return redirect()
            ->route('student.profile.index')
            ->with('success', 'Profile updated successfully');
    }

    // Upload profile photo
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete('profile/' . $user->profile_photo);
        }

        $filename = time() . '.' . $request->profile_photo->extension();
        $request->profile_photo->storeAs('profile', $filename, 'public');

        $user->update([
            'profile_photo' => $filename,
        ]);

        return back()->with('success', 'Profile photo updated');
    }
}
