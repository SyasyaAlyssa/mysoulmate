<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Models\PreMarriageCourse;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = PreMarriageCourse::where('is_published', 1)->get();

        return view('guardian.dashboard', compact('courses'));
    }
}
