<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get current uploaded image (if any)
        $image = session('uploaded_image', null); // For demo, or you can fetch from DB
        return view('admin.dashboard', compact('image'));
    }

    public function showUploadForm()
    {
        return view('admin.upload-photo');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048', // max 2MB
        ]);

        // Store image in storage/app/public/photos
        $path = $request->file('photo')->store('photos', 'public');

        // Save path in session (or in DB for persistence)
        session(['uploaded_image' => $path]);

        return redirect()->route('admin.dashboard')->with('success', 'Photo uploaded successfully!');
    }
}
