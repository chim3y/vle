<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Yajra\Datatables\Datatables;
use App\Course;
use App\Programme;
use App\Semester;
use App\Course_Programme;
use App\Content;
use App\User;
use App\Admin;
use App\Quiz;
use Image;
use Storage;
use Auth;
use Hash;
use Session;

class CoursesController extends Controller
{



 public function index()
    {
    
        return view('courses.index');
        
    }

public function coursesData(){
   

 $course = Course::with('programmes', 'semesters')->get();


return Datatables::of($course)
            ->addColumn('action', function ($course) {
                return view('admin.courses.partials.editanddelete', compact('course'))->render();
}) 
->addColumn('programme_name', function (Course $course) {
                    return $course->programmes->map(function($programmes) {
                        return $programmes->programme_name;
                    })->implode(',<br>');
           })
 ->addColumn('semester_name', function (Course $course) {
                    return $course->semesters->map(function($semesters) {
                        return $semesters->semester_name;
                    })->implode(',<br>');
           }) 
 ->editColumn('name', function ($course) {

if (is_null($course->user_id)) {
  $admin=Admin::where('id', '=', $course->admin_id)->first();
  $admin_name=$admin->name;
    return 'Admin: '. ucfirst(trans($admin_name));
}
else{
  $tutor=User::where('id', '=', $course->user_id)->first();
  $tutor_name=$tutor->name;
  return 'Tutor: '. ucfirst(trans($tutor_name));
}
    }) 


->make(true); 
      
   }

    

    public function show($id){
       $course = Course::with("semesters","programmes","user","admin","contents.lectures", "contents.assignments", "quizes")->find($id);
    
      $course_id= $course->id;

      session()->put('course_id',$course_id);
  
      return view('admin.courses.show')->withCourse($course);
    }


  
   

}
