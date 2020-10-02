<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\photo;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id','desc')->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            return redirect('/admin/courses')->withStatus('Course Succsessfully Created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Course $course)
    {
        $rules= [
            'title'=> 'required|min:20|max:150',
            'status' => 'required|integer|in:0,1',
            'link' => 'required',
            'track_id' => 'required|integer'
        ];
        
        $this->validate($request, $rules);

        $course->update($request->all());

        // Insert The image
        if($file = $request->file('image')) {
            $filename = $file->getClientOriginalName();
            $fileExtention = $file->getClientOriginalExtension();
            
            $file_to_store = time() . '_' . explode('.',$filename)[0] . '_.' . $fileExtention;

            if($file->move('courses', $file_to_store)) {
                if($course->photo){
                    $photo = $course->photo;
                    // remove the old image
                    $filename = $photo->filename;
                    unlink('courses/'.$filename);

                    $photo->filename = $file_to_store;
                    $photo->save();
                } else {
                    photo::create([
                        'filename'=>$file_to_store,
                        'photoable_id'=> $course->id, 
                        'photoable_type'=> 'App\Course', 
                        ]);
                }
            }
        }
        return redirect('/admin/courses')->withStatus('Course Succsessfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        # Delete Photo From Server
        if($course->photo){
            $filename = $course->photo->filename;
            unlink('courses/'.$filename);
        }
        # Delete Photo From DB
        $course->photo->delete();
        $course->delete();
        return redirect('/admin/courses')->withStatus('Course Succsessfully Deleted');
    }
}
