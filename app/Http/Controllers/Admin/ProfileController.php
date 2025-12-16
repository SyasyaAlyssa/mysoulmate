<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('admin.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.profiles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => 'nullable|image',
            'name' => 'required',
            'phone' => 'nullable',
            'gender' => 'nullable',
            'dob' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        $data['user_id'] = auth()->id();

        Profile::create($data);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile created!');
    }

    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'photo' => 'nullable|image',
            'name' => 'required',
            'phone' => 'nullable',
            'gender' => 'nullable',
            'dob' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            $data['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        $profile->update($data);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile updated!');
    }

    public function destroy(Profile $profile)
    {
        if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
            Storage::disk('public')->delete($profile->photo);
        }

        $profile->delete();

        return back()->with('success', 'Profile deleted!');
    }
}
