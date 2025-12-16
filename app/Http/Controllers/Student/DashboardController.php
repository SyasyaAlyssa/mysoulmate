<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\PreMarriageCourse;



class DashboardController extends Controller
{
    public function index()
{
    $courses = PreMarriageCourse::where('is_published', 1)->get();
    return view('student.dashboard', compact('courses'));
}
}
