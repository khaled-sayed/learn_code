<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\photo;
use App\Track;
use Illuminate\Http\Request;

class TrackCourseController extends Controller
{

    public function create(Track $track)
    {
        return view('admin.tracks.trackcourse', compact('track'));
    }

    public function store(Request $request, Track $track)
    {
        $rules= [
            'title'=> 'required|min:20|max:150',
            'status' => 'required|integer|in:0,1',
            'link' => 'required',
            'track_id' => 'required|integer'
        ];
        
        $this->validate($request, $rules);
        $course = Course::create($request->all());

        if($course){
            // Insert The image
            if($file = $request->file('image')) {
                $filename = $file->getClientOriginalName();
                $fileExtention = $file->getClientOriginalExtension();
                
                $file_to_store = time() . '_' . explode('.',$filename)[0] . '_.' . $fileExtention;

                if($file->move('courses', $file_to_store)) {
                    photo::create([
                        'filename'=>$file_to_store,
                        'photoable_id'=> $course->id, 
                        'photoable_type'=> 'App\Course', 
                        ]);
                }
            }
            return redirect()->back()->withStatus('Course Succsessfully Created');
        }
    }

    
}
