<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Http\Requests\ContentRequest;
use Session;

class ContentController extends Controller
{
   public function __construct() {
    
    $this->middleware('auth');   
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function create()
    {   
            return view('contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
    {
        $content= new Content();
        $content->name = $request->name;
        $content->description = $request->description;
        foreach (session('course_id') as $course_id) {
           $content->course_id= $course_id;
        }
       
        $content->save();

    
        return redirect('/courses/'.$content->course_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
        $content= Content::findOrFail($id);
        $content->delete();

        foreach (session('course_id') as $course_id) {
           $content->course_id= $course_id;
        }
         return redirect('/courses/'.$content->course_id);
   
    }
}
