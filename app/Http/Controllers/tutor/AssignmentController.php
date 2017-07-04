<?php

namespace App\Http\Controllers\tutor;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use Session;
use App\Assignment;
use App\AssignmentSubmission;
use File;
use App\Content;
use Auth;
use App\User;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contentId)
    {
        return view('tutor.assignments.create', compact('contentId'));
    }


public function submissionData($contentId,$id){
   
 $submission = AssignmentSubmission::where('status', 1)->where('assignment_id', $id)->get();

return Datatables::of($submission)
            ->addColumn('action', function ($submission) {
                $assignment=Assignment::where('id', $submission->assignment_id)->get();
                return view('tutor.assignments.partials.editanddelete', compact('submission', $submission))->withAssignment($assignment)->render();
}) 

 ->editColumn('name', function ($submission) {

  $student=User::where('id', '=', $submission->user_id)->first();
  $student_name=$student->name;
  return ucfirst(trans($student_name));
}) 
  ->editColumn('grade', function ($submission) {
   return view('tutor.assignments.partials.assignmentsubmission', compact('submission'))->render();
    })
->escapeColumns([])
->make(true); 
      
 }

public function view($contentId, $assignmentId,$id ){
$submission=AssignmentSubmission::find($id);
$assignment=Assignment::find($assignmentId);
$user=User::where('id', $submission->user_id)->first()->name;
return view('tutor.assignments.submission.view', compact('submission',$submission))->withAssignment($assignment)->withUser($user);
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
         
        $assignment->course_id= Content::find( $assignment->content_id )->course_id;
      
      
       
        $assignment->save();

       
        return redirect('/tutor/courses/'.$assignment->course_id);
    
    
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
    public function edit($contentId, $id)
    {
        $assignment= Assignment::findorfail($id);


       return view('tutor.assignments.edit', compact('assignment', $assignment))->with('contentId', $contentId)->with('id', $id);
    }


  public function download($file_name) {
    $file_path = public_path('uploads/assignments/'.$file_name);
    return response()->download($file_path);
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


         $oldfilename=$assignment->document;  
          if (!empty($oldfilename)){ 
             File::delete('uploads/assignments/'.$oldfilename);
        }
        $assignment->document = $filename;
        }
        else{
        $assignment->document = $assignment->document;    
        }

        $assignment->assignment_title= $request->assignment_title;
        $assignment->description = $assignment->description;
        $assignment->content_id  = $contentId;  
         $assignment->max_grade =$request->max_grade; 
          $assignment->course_id= session('course_id');
   
        $assignment->save();

      
        return redirect('/tutor/courses/'.$assignment->course_id);
       
        
    }

        public function show($contentId,$assignmentId, $assignment_title){
$assignment=Assignment::find($assignmentId);


        $now = Carbon::now();    
        $due = Carbon::parse($assignment->due_date);
        $leftdays =Carbon::now()->diffInDays($due);
        $lefthours =Carbon::now()->copy()->addDays($leftdays)->diffInHours($due);
        $leftminutes = Carbon::now()->copy()->addDays($leftdays)->addHours($lefthours)->diffInMinutes($due);

  
  return view('tutor.assignments.show')->withAssignment($assignment)->withNow($now)->withDue($due)->withLeftdays($leftdays)->withLefthours($lefthours)->withLeftminutes($leftminutes);
        
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

           $assignment->course_id= session('course_id');
        



         return redirect('/tutor/courses/'.$assignment->course_id);
   
    
}
}
