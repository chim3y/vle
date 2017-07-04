<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use App\AssignmentSubmission;
use App\Student;
use App\Tutor;
use App\Admin;
use Session;
use App\Assignment;
use App\User;
use File;
use App\Course;
use Carbon\Carbon;
use Input;
use Auth;
use App\Notifications\AssignmentSubitted;
class AssignmentSubmissionController extends Controller
{
   
 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request, $contentId,$assignmentId)
    {
     $data = Input::all();
     $assignment=Assignment::with('assignmentsubmission')->find($assignmentId);
    if(isset($data['save-draft'])){
      
$assignmentsubmission = new AssignmentSubmission;  

 if($request->hasfile('document')){
             $destinationPath = '';
        $filename = '';
        $size = round(($request->file('document')->getSize()) / 1024, 2); //round of to 2 decimal place in KB
        $file = $request->file('document');
        $destinationPath =public_path('uploads/assignments/submissions/',$filename);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        $filename = time(). '.' .$file->getClientOriginalName();

        $file->move($destinationPath, $filename);

        }
          $assignmentsubmission->document = $filename;

if(Auth::guard('admin')->check()){
    $assignmentsubmission->admin_id= Auth::guard('admin')->user()->id;
}
elseif(Auth::guard('web')->check()){
   $assignmentsubmission->user_id= Auth::guard('web')->user()->id; 
}


$assignmentsubmission->description = $request->description;

$assignmentsubmission->assignment_id= $assignmentId;    
$assignmentsubmission->status= 0;       
$assignmentsubmission->save();

return redirect('/student/courses/'.$assignment->course_id);

 } 

 elseif(isset($data['save'])){
     
$assignmentsubmission = new AssignmentSubmission;     
if(Auth::guard('admin')->check()){
    $assignmentsubmission->admin_id= Auth::guard('admin')->user()->id;
}
elseif(Auth::guard('web')->check()){
   $assignmentsubmission->user_id= Auth::guard('web')->user()->id; 
}
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


         $oldfilename=$assignmentsubmission->document;   
              if (!empty($oldfilename)){
             File::delete('uploads/assignments/submissions'.$oldfilename);
           }
        $assignmentsubmission->document = $filename;
        }
                   
$assignmentsubmission->description = $request->description;
$assignmentsubmission->assignment_id= $assignmentId;
$assignmentsubmission->status= 1;    
$assignmentsubmission->save();
return redirect('/student/courses/'.$assignment->course_id);


}

}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function show($contentId,$assignmentId)
    {

       $assignment=Assignment::with('assignmentsubmission')->find($assignmentId);
       $uid= Auth::guard('web')->user()->id;
       $submission= AssignmentSubmission::where('assignment_id', $assignmentId)->where('user_id', $uid)->first();
      
      if(is_null($submission)){

       return $this->create($contentId,$assignmentId);
      }
      else{
         $id=$submission->id;
         return $this->edit($contentId,$assignmentId,$id);
    }   
      }


public function create($contentId,$assignmentId){
$assignment=Assignment::find($assignmentId);

$uid= Auth::guard('web')->user()->id;
$student_id=Student::where('user_id', $uid)->value('id');
$student=Student::find($student_id);
$course_id= $assignment->course_id;
$course=Course::find($course_id);
$condition= $course->student->contains($student);

if (!$condition){

         Session::flash('success', 'Please enter correct enrollment key');
      return view('student.courses.enroll', compact('course',$course ))->withStudentId($student_id);
  }
        $now = Carbon::now();    
        $due = Carbon::parse($assignment->due_date);
        $leftdays =Carbon::now()->diffInDays($due);
        $lefthours =Carbon::now()->copy()->addDays($leftdays)->diffInHours($due);
        $leftminutes = Carbon::now()->copy()->addDays($leftdays)->addHours($lefthours)->diffInMinutes($due);

  
  return view('student.assignments.create')->withAssignment($assignment)->withNow($now)->withDue($due)->withLeftdays($leftdays)->withLefthours($lefthours)->withLeftminutes($leftminutes);
        
}



public function edit($contentId,$assignmentId, $id ){
$assignment=Assignment::with('assignmentsubmission')->find($assignmentId);
$uid= Auth::guard('web')->user()->id;
$submission= AssignmentSubmission::where('assignment_id', $assignmentId)->where('user_id', $uid)->first();
$assignment=Assignment::with('assignmentsubmission')->find($assignmentId);
       $uid= Auth::guard('web')->user()->id;
       $student_id=Student::where('user_id', $uid)->value('id');
       $student=Student::find($student_id);
       $course_id= $assignment->course_id;
       $course=Course::find($course_id);
        $condition= $course->student->contains($student);

if (!$condition){

         Session::flash('success', 'Please enter correct enrollment key');
      return view('student.courses.enroll', compact('course',$course ))->withStudentId($student_id);
  }
        $now = Carbon::now();    
        $due = Carbon::parse($assignment->due_date);
        $leftdays =Carbon::now()->diffInDays($due);
        $lefthours =Carbon::now()->copy()->addDays($leftdays)->diffInHours($due);
        $leftminutes = Carbon::now()->copy()->addDays($leftdays)->addHours($lefthours)->diffInMinutes($due);

        return view('student.assignments.show1')->withAssignment($assignment)->withNow($now)->withDue($due)->withLeftdays($leftdays)->withLefthours($lefthours)->withLeftminutes($leftminutes)->withsubmission($submission);
        
}
  public function downloadsub($filename) {
    $file_path = public_path('uploads/assignments/submissions/'.$filename);
    return response()->download($file_path);
  }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contentId, $assignmentId,$id)
    {
    $data = Input::all();
    
    if(isset($data['update'])){
      
      $assignmentsubmission=AssignmentSubmission::find($id);
      $assignment=Assignment::find($assignmentId);  
     
if(Auth::guard('admin')->check()){
    $assignmentsubmission->admin_id= Auth::guard('admin')->user()->id;
}
elseif(Auth::guard('web')->check()){
   $assignmentsubmission->user_id= Auth::guard('web')->user()->id; 
  
}
if($request->hasfile('document')){
             $destinationPath = '';
        $filename = '';
        $size = round(($request->file('document')->getSize()) / 1024, 2); //round of to 2 decimal place in KB
        $file = $request->file('document');
        $destinationPath =public_path('uploads/assignments/submissions/',$filename);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        $filename = time(). '.' .$file->getClientOriginalName();
        $file->move($destinationPath, $filename);

      
         $oldfilename=$assignmentsubmission->document;  
           if (!empty($oldfilename)){
             File::delete('uploads/assignments/submissions/'.$oldfilename);
           }

        $assignmentsubmission->document = $filename;
        }
       
$assignmentsubmission->description = $request->description;
$assignmentsubmission->assignment_id= $assignmentId; 
if($assignmentsubmission->status==1){
  $assignmentsubmission->status= 1;
}
else{
    $assignmentsubmission->status= 0;
}


$assignmentsubmission->save();

return redirect('/student/contents/'.$assignment->content_id.'/assignments/'.$assignment->id);
   
 } 

 elseif(isset($data['save'])){
     
$assignmentsubmission=AssignmentSubmission::find($id); 
$assignment=Assignment::find($assignmentId); 
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


         $oldfilename=$assignmentsubmission->document;   
              if (!empty($oldfilename)){
             File::delete('uploads/assignments/submissions'.$oldfilename);
           }
        $assignmentsubmission->document = $filename;
        }
            
if(Auth::guard('admin')->check()){
    $assignmentsubmission->admin_id= Auth::guard('admin')->user()->id;
}
elseif(Auth::guard('web')->check()){
   $assignmentsubmission->user_id= Auth::guard('web')->user()->id; 
}
       
$assignmentsubmission->description = $request->description;
$assignmentsubmission->assignment_id= $assignmentId;
$assignmentsubmission->status= 1;    
$assignmentsubmission->save();
return redirect('/student/contents/'.$assignment->content_id.'/assignments/'.$assignment->id);
 $admin=Admin::find(4);
$admin->notify(new AssignmentSubmitted($assignmentsubmission));

    }

   }
}
