<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display list of students (except logged-in user)
     */
    public function index()
    {
        $students = User::where('role', 'student')
            ->where('id', '!=', auth()->id())
            ->get();

        return view('student.students.index', compact('students'));
    }
}
