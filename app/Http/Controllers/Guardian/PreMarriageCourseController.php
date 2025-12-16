<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PreMarriageCourse;

class PreMarriageCourseController extends Controller
{
  public function index()
{
    $courses = PreMarriageCourse::where('is_published', true)->get();
    return view('guardian.courses.index', compact('courses'));
}


}