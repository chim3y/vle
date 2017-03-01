<?php

namespace App\Http\Controllers;
use App\Http\Requests\CourseRequest;
use Yajra\Datatables\Datatables;
use App\Course;
use App\Programme;
use App\Semester;
use App\Course_Programme;
use Image;
use Storage;
use Auth;
use Session;

class CoursesController extends Controller
{

public function __construct() {
    
    $this->middleware('auth');
   
}


    public function index()
    {
        
        return view('courses.index');
        
    }


     public function coursesData(){

         $course = Course::with("user")
            ->get();
            return Datatables::of($course)
            ->addColumn('action', function ($course) {
                return '<a href="/courses/'.$course->id.'/edit"> <span class="glyphicon glyphicon-edit" style="color:black"> </span> </a>';
             
            }) 
            ->editColumn('name', function ($course) {
 return '<a  class="btn btn-default" data-toggle="modal" data-target="#myModal" style="color:inherit"> '
                  .$course->user->name. 
                   '<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" data-backdrop="false">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>'.' </a>';

            })

            ->make(true);  
      
   }


   
    public function create(){

       $course=Course::all();
       $programmes=Programme::all();
       $semesters=Semester::all();
    
    return view ('courses.create')->withCourses($course)->withProgrammes($programmes)->withSemesters($semesters);

    }

     public function store(CourseRequest $request){
        
        $course = new Course;
        if($request->hasfile('image')){
        $image=$request->file('image');
        $filename=time(). '.' .$image->getClientOriginalExtension();
        $location=public_path('images/courses/'.$filename);
        Image::make($image)->resize(100, 100)->save($location);
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
       
         
         $course->semesters()->attach($semester_id, array('programme_id'=>$programme_id));
         $course->semesters()->attach($semester_id, array('programme_id'=>$programme_id));
        
        Session::flash('success', 'This course was successfully created');
        return redirect('courses');
       
    }
  
    public function show($id){
       $course = Course::with("semesters.programmes","user")->find($id)->join("contents",'content_id','=','contents.id');

       return view('courses.show')->withCourse($course);
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
      
       return view('courses.edit', compact('course'))->withProgrammes($programmes2)->withSemesters($semesters2);
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
        
        $semester_id= $request->semester_id;
        $programme_id= $request->programme_id; 
       
     
         $course->semesters()->attach($semester_id, array('programme_id'=>$programme_id));
     
    
        Session::flash('success', 'This course was successfully edited');
        return redirect('courses');
    }


   

}
