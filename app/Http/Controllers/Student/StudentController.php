<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function listStudents()
    {
        return view('student.students.index'); // adjust if needed
    }

    public function sendRequest($id)
    {
        // logic later
        return back()->with('success', 'Request sent');
    }
}
