<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Quiz;
use Illuminate\Http\Request;

class CourseQuizController extends Controller
{

    public function create(Course $course)
    {
        return view('admin.courses.createquiz', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $rules = [
            'name' => 'required|min:10|max:100',
            'course_id' => 'required|int' 
        ];

        $this->validate($request, $rules);
        $quiz = Quiz::create($request->all());

        if($quiz) {
            return redirect('/admin/quizzes')->withStatus('Quiz Successfully Created .');
        } else {
            return redirect()->back()->withStatus('Something Wrong , Try Agin');
        }
    }

}
