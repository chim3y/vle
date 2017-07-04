<?php

namespace App\Http\Controllers\tutor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Content;
use App\Http\Requests\ContentRequest;
use Session;

class ContentController extends Controller
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function create()
    {   
            return view('tutor.contents.create');
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
      
           $content->course_id= session('course_id') ;
    
       
        $content->save();
        return redirect('/tutor/courses/'.$content->course_id);
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

       $content= Content::findorfail($id);
      
       return view('tutor.contents.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, $id)
    {
        $content = Content::findorfail($id);
        $content->name = $request->name;
        $content->description = $request->description;
        $content->course_id= session('course_id');
        $content->save();

    
        return redirect('/tutor/courses/'.$content->course_id);
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

     
           $content->course_id=session('course_id');
           
         return redirect('/tutor/courses/'.$content->course_id);
   
    }
}
