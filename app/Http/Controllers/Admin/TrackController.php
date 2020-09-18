<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::orderBy('id', 'desc')->paginate(20);

        return view('admin.tracks.index', compact('tracks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:50'
        ];

        $this->validate($request, $rules);

        if(Track::create($request->all())){
            return redirect('/admin/tracks')->withStatus('Track Successfully Created');
        } else {
            return redirect('/admin/tracks')->withStatus('Something Wrong, Try Agin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        return view('admin.tracks.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        $rules = [
            'name' => 'required|min:3|max:50'
        ];

        $this->validate($request, $rules);

        if($request->has('name')){
            $track->name = $request->name;
        }

        if($track->isDirty()) {
            $track->save();
            return redirect('/admin/tracks')->withStatus('Track Successfully Updated');
        } else {
            return redirect('/admin/tracks/'.$track->id.'/edit')->withStatus('Something Wrong, Try Agin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        $track->delete();
        return redirect('/admin/tracks')->withStatus('Track Successfully Deleted');
    }
}
