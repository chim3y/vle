<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Requests\CourseRequest;
use Yajra\Datatables\Datatables;
use App\Course;
use App\Programme;


use Auth;
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

         	return view ('courses.create')->withCourses($course)->withProgrammes($programmes);

    }

     public function store(CourseRequest $request ){
        
        $course = new Course;
        $course->user_id = Auth::user()->id;
        $course->course_name=$request->course_name;
        $course->course_code=$request->course_code;
        $course->credits=$request->credits;
        $course->description=$request->description;
        $course->created_at =$request->created_at;
        $course->updated_at= $request->updated_at;
        $course->save();

        $course->programmes()->sync($request->programme_id,false);

        return redirect('courses');
       
    }
  
    public function show($id){
       $course= Course::find($id);
      
       return $course;
    }


     public function edit($id){
       $programmes=Programme::all();
      

       $course= Course::findorfail($id);
      
       return view('courses.edit', compact('course','programmes'));
    }

    public function update($id, CourseRequest $request){
        $course = Course::findorfail($id);
        $course->user_id = Auth::user()->id;
        $course->course_name=$request->course_name;
        $course->course_code=$request->course_code;
        $course->credits=$request->credits;
        $course->description=$request->description;
        $course->created_at =$request->created_at;
        $course->updated_at= $request->updated_at;
        $course->update($request->all());
        $course->programmes()->sync($request->programme_id, true);
        return redirect('courses');
    }


   

}
