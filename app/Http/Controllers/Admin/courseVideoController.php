<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;

class courseVideoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('admin.courses.createvideo', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $rules = [
            'title' => 'required|min:10|max:100',
            'link' => 'required|url',
            'course_id' => 'required|int'
        ];

        $this->validate($request, $rules);
        $video = Video::create($request->all());

        if($video) {
            return redirect('/admin/courses/'.$course->id)->withStatus('Video Successfully Created.');
        } else {
            return redirect('/admin/courses/'.$course->id.'/videos/create')->withStatus('Video Not Created.');
        }
    }

}
