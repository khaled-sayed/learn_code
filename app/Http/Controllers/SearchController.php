<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $courses = Course::where('title','LIKE','%'. $q . '%')->get();

        return view('search', compact('courses'));
    }
}
