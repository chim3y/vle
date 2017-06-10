<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollRequest;
use Yajra\Datatables\Datatables;
use App\Course;
use App\Student;
use App\Programme;
use App\Semester;
use App\Course_Programme;
use App\Content;
use App\User;
use App\Admin;
use Image;
use Storage;
use Auth;
use Session;
use Hash;

class CoursesController extends Controller
{

 public function index()
    { 

        return view('student.courses.index');
        
    }


public function coursesData(){
   

 $course = Course::with('programmes', 'semesters')->get();

return Datatables::of($course)  
->addColumn('action', function ($course) {
                return view('student.courses.partials.view', compact('course'))->render();
}) 
  
            ->addColumn('programme_name', function (Course $course) {
                    return $course->programmes->map(function($programmes) {
                        return $programmes->programme_name;
                    })->implode('<br>');
           }) 
             ->addColumn('semester_name', function (Course $course) {
                    return $course->semesters->map(function($semesters) {
                        return $semesters->semester_name;
                    })->implode('<br>');
           }) 

->editColumn('course_name', function ($course) {
 return  $course->course_name;
           }) 

->make(true); 

  
   }

   

     public function show($id){

      $course = Course::with("semesters","programmes","user","admin","contents.lectures", "contents.assignments")->find($id);


       $uid= Auth::guard('web')->user()->id;
       $student_id=Student::where('user_id', $uid)->value('id');
       $student=Student::find($student_id);
       $course_id= $course->id;

      session()->put('course_id',$course_id);

if (!$course->student->contains($student)){
      
      Session::flash('success', 'Please enter correct enrollment key');
      return view('student.courses.enroll', compact('course',$course ))->withStudentId($student_id);
    }
 
  return view('student.courses.show', compact('course',$course ));



  
}


 public function enroll(EnrollRequest $request){
      $id= session('course_id');
      $course=Course::find($id);
       $course_id= $course->id;

      session()->put('course_id',$course_id);
      $student_id=$request->student_id;
        $student =Student::find($student_id);
       
        $enrollment_key= $request->enrollment_key; 
 


     $check=  Hash::check($enrollment_key, $course->enrollment_key);

 
    if($check=='true'){

    $student->course()->attach($id);
 
    return redirect()->route('student.courses.show', array('id' => $id ));
        }
    elseif($check=='false')
       
        Session::flash('success', 'Please enter correct enrollment key');
      return view('student.courses.enroll', compact('course',$course ))->withStudentId($student_id);
    }

}
