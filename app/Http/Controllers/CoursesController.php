<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index($slug)
    {
        $course = Course::where('slug', $slug)->first();

        return view('course', compact('course'));
    }
}
