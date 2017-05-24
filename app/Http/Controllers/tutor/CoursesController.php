<?php

namespace App\Http\Controllers\tutor;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Yajra\Datatables\Datatables;
use App\Course;
use App\Programme;
use App\Semester;
use App\Course_Programme;
use App\Content;
use App\User;
use Image;
use Storage;
use Auth;
use Session;

class CoursesController extends Controller
{

 public function index()
    {
   
        return view('tutor.courses.index');
        
    }

public function coursesData(){
   
 $user= User::find(Auth::user()->id);
 $course = $user->courses()->with('programmes', 'semesters')->get();

return Datatables::of($course)
            ->addColumn('action', function ($course) {
                return '<a href="/tutor/courses/'.$course->id.'/edit"> <span class="glyphicon glyphicon-edit" style="color:black"> </span> </a>';
             
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
 return '<a  target="_blank" style="color:black" href="/tutor/courses/'
                  .$course->id.'"> '.$course->course_name.'</a>';
           }) 

->make(true); 

      
   }


   
    public function create(){

       $course=Course::all();
       $programmes=Programme::all();
       $semesters=Semester::all();
    
    return view ('tutor.courses.create')->withCourses($course)->withProgrammes($programmes)->withSemesters($semesters);

    }

     public function store(CourseRequest $request){
        
        $course = new Course;
        if($request->hasfile('image')){
        $image=$request->file('image');
        $filename=time(). '.' .$image->getClientOriginalExtension();
        $location=public_path('images/courses/'.$filename);
        Image::make($image)->resize(150, 150)->save($location);
        $course->image=$filename;
        }
        $course->user_id = Auth::user()->id;
        $course->course_name=$request->course_name;
        $course->course_code=$request->course_code;
        $course->credits=$request->credits;
        $course->description=$request->description;
        $course->save();
       $semester_id= $request->semester_id;
        $programme_id= $request->programme_id; 

 $course->programmes()->attach($programme_id, array('semester_id'=>$semester_id));
 
    
        Session::flash('success', 'This course was successfully created');
        return redirect()->route('admin.courses');
  }

    public function show($id){
       $course = Course::with("semesters","programmes","user","contents.lectures")->find($id);

      $course_id= ["course_id"=>$course->id];
      session()->put('course_id',$course_id);
  
      return view('tutor.courses.show')->withCourse($course);
    }


     public function edit($id){
       $programmes=Programme::all();
       $programmes2=array();
       foreach ($programmes as $programme) {
         $programmes2[$programme->id] = $programme->programme_name;
       }

       $semesters=Semester::all();
       $semesters2=array();
       foreach ($semesters as $semester) {
         $semesters2[$semester->id] = $semester->semester_name;
       }
       $course= Course::findorfail($id);
      
       return view('tutor.courses.edit', compact('course'))->withProgrammes($programmes2)->withSemesters($semesters2);
    }

    public function update(CourseRequest $request, $id){
        $course = Course::findorfail($id);
        if($request->hasfile('image')){
          //Add new image
        $image=$request->file('image');
        $filename=time(). '.' .$image->getClientOriginalExtension();
        $location=public_path('images/courses/'.$filename);
        Image::make($image)->resize(100, 100)->save($location);
        //Save old image
        $oldFilename=$course->image;
        //update new image
        $course->image=$filename;
        //delete old image
        Storage::delete($oldFilename);
        }
        $course->user_id = Auth::user()->id;
        $course->course_name=$request->course_name;
        $course->course_code=$request->course_code;
        $course->credits=$request->credits;
        $course->description=$request->description;
        $course->save();
        
          // Operation on course_programme table2
      
         $semester_id= $request->semester_id;
        $programme_id= $request->programme_id;     
 
 $course->programmes()->attach($programme_id, array('semester_id'=>$semester_id));
           
        Session::flash('success', 'This course was successfully edited');
        return redirect('tutor.courses');
    }


   

}
