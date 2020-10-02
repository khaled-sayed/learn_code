<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{

    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.createquestion', compact('quiz'));
    }


    public function store(Request $request, Quiz $quiz)
    {
        $rules = [
            'title' => 'required|min:10|max:1000',
            'answers' => 'required|min:10|max:1000',
            'right_answer' => 'required|min:3|max:50',
            'quiz_id' => 'required|integer',
            'score' => 'required|integer|min:5|max:30'
        ];
        $this->validate($request, $rules);

        $question = Question::create($request->all());

        if($question) {
            return redirect('/admin/questions')->withStatus('Create Question Successfully .');
        } else {
            return redirect('/admin/questions/create')->withStatus('Something Wrong , Try Agin .');
        }
    }

    
}
