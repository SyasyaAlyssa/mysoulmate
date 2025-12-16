<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\StudentNotification;

class MessageController extends Controller
{
    public function index()
{
    $students = User::where('role', 'student')->where('id', '!=', auth()->id())->get();
    return view('student.messages.index', compact('students'));
}

    /**
     * Show list of students
     */
    public function users()
    {
        $students = User::where('role', 'student')
            ->where('id', '!=', auth()->id())
            ->get();

        return view('student.messages.users', compact('students'));
    }

    /**
     * Show chat with selected student
     */
    public function chat(User $user)
    {
        $messages = Message::where(function ($q) use ($user) {
                $q->where('sender_id', auth()->id())
                  ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->where('receiver_id', auth()->id());
            })
            ->orderBy('created_at')
            ->get();

        return view('student.messages.chat', compact('user', 'messages'));
    }

    /**
     * Send message
     */
    public function send(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        // 🔔 Create notification for receiver
        StudentNotification::create([
            'user_id' => $user->id,
            'title' => 'New Message',
            'body' => auth()->user()->name . ' sent you a message',
            'is_read' => false,
        ]);

        return back();
    }
}
