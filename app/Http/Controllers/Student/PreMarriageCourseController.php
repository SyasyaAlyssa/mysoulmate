<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PreMarriageCourse;

class PreMarriageCourseController extends Controller
{
   public function index()
{
    $courses = PreMarriageCourse::where('is_published', true)->get();
    return view('student.courses.index', compact('courses'));
}

public function show(\App\Models\PreMarriageCourse $course)
{
    return view('student.courses.show', compact('course'));
}


}
