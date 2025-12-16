<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentNotification; // ✅ ADD THIS LINE

class NotificationController extends Controller
{
    public function index()
{
    $notifications = StudentNotification::where('user_id', auth()->id())
        ->with('sender') // eager load sender
        ->latest()
        ->get();

    // Mark all as read
    StudentNotification::where('user_id', auth()->id())
        ->update(['is_read' => true]);

    return view('student.notifications.index', compact('notifications'));
}

    public function accept($id)
    {
        return back()->with('success', 'Request accepted');
    }

    public function reject($id)
    {
        return back()->with('success', 'Request rejected');
    }
}
