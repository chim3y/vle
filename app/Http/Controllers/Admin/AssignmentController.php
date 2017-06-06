<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use Session;
use App\Assignment;
use File;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contentId)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contentId)
    {
        return view('admin.assignments.create', compact('contentId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentRequest $request, $contentId)
    {
        
       
        $assignment = new Assignment;
        if($request->hasfile('document')){
             $destinationPath = '';
        $filename = '';
        $size = round(($request->file('document')->getSize()) / 1024, 2); //round of to 2 decimal place in KB
        $file = $request->file('document');
        $destinationPath =public_path('uploads/assignments/',$filename);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        $filename = time(). '.' .$file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $assignment->document = $filename;
        }
        else{
        $assignment->document = $assignment->document;    
        }
        $assignment->assignment_title= $request->assignment_title;

        $assignment->start_date=$request->input('start_date');
        
         $assignment->due_date=$request->input('due_date');
         $assignment->max_grade=$request->max_grade;
       

        $assignment->description = $assignment->description;
        $assignment->content_id  = $contentId;
         
          $assignment->course_id= session('course_id');
      
       
        $assignment->save();

       
        return redirect('/admin/courses/'.$assignment->course_id);
    
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $assignment_title)
    {
        $assignment=Assignment::findorfail($id);

        return view('admin.assignments.show')->withAssignment($assignment); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contentId, $id)
    {
        $assignment= Assignment::findorfail($id);
    

       return view('admin.assignments.edit', compact('assignment'))->with('contentId', $contentId)->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentRequest $request, $contentId, $id)
    {
        $assignment = Assignment::findorfail($id);
             if($request->hasfile('document')){
        $destinationPath = '';
        $filename = '';
        $size = round(($request->file('document')->getSize()) / 1024, 2); //round of to 2 decimal place in KB
        $file = $request->file('document');
        $destinationPath =public_path('uploads/assignments/',$filename);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        $filename = time(). '.' .$file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        //Save old image
        $oldFilename=$assignment->document;
        //update new image
        $assignment->document=$filename;
        //delete old image
        Storage::delete($oldFilename);
        }
   
       

        $assignment->assignment_title= $request->assignment_title;
        $assignment->description = $assignment->description;
        $assignment->content_id  = $contentId;
         foreach (session('course_id') as $course_id) {
          $assignment->course_id= $course_id;
        }
       
        $assignment->save();

      
        return redirect('/admin/courses/'.$lecture->course_id);
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
       $assignment= Assignment::findOrFail($id);
       
     if(!is_null($assignment)) {
        $assignment->delete();
        }

      foreach (session('course_id') as $course_id) {
           $assignment->course_id= $course_id;
        
    }


         return redirect('/admin/courses/'.$assignment->course_id);
   
    
}
}
