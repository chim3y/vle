<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LectureRequest;
use Session;
use App\Lecture;


class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    
    public function create($id)
    {    
        $content_id=$id;
        return view('lectures.create', compact('content_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LectureRequest $request)
    {
        $lecture= new Lecture();
        $lecture->lecture_name = $request->lecture_name;
        $lecture->description = $request->description;
        $lecture->document = $request->document;

        foreach (session('course_id') as $course_id) {
           $lecture->course_id= $course_id;

        }
        
       $lecture->content_id=$request->content_id;
       $lecture->save();


        return redirect('/admin/courses/'.$lecture->course_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
