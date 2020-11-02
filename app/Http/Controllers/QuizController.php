<?php

namespace App\Http\Controllers;

use App\Course;
use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index($slug, $name)
    {
        $course = Course::where('slug', $slug)->first();
        $quiz = $course->quizzes()->where('name', $name)->first();

        return view('quiz', compact('quiz'));
    }

    public function submit($slug, $name, Request $request)
    {
        $quiz = Quiz::where('name', $name)->first();
        $questions = $quiz->question;
        $quiz_score = 0;
        $question_ids = [];
        $question_answers = [];
        foreach ($questions as $question)
        {
            $question_ids[] = $question->id;
            $question_answers[] = $question->right_answer;
            $quiz_score += $question->score;
        }

        for ($i = 0; $i < count($question_ids); $i++)
        {
            $your_answer =trim($request['answer'.$question_ids[$i]]);
            $the_answer = trim($question_answers[$i]);

            if($your_answer != $the_answer)
            {
                return redirect()->back()->withStatus("Your answer ( ". $your_answer ." ) is not correct.");
            }
        }
        $user = auth()->user();
        $user->quizzes()->attach([$quiz->id]);
        // Increment User Score
        $user->score += $quiz_score;
        if ($user->save()) {
            return redirect("/courses/" . $quiz->course->slug)->withStatus("Well done, You've solved {$quiz->name} Quiz and earned " . $quiz_score . " point.");
        }
        }
}
