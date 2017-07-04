<?php

namespace App\Http\Controllers\Admin;
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
    
        return view('admin.courses.index');
        
    }

public function coursesData(){
   

 $course = Course::with('programmes', 'semesters', 'user','admin' )->get();

return Datatables::of($course)
            ->addColumn('action', function ($course) {
                return view('admin.courses.partials.editanddelete', compact('course'))->render();
}) 
            ->rawColumns(['action'])
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
 ->editColumn('course_name', function ($course) {
 return '<a  target="_blank" style="color:black" href="/admin/courses/'
                  .$course->id.'"> '.$course->course_name.'</a>';
           })
 
->escapeColumns([])


->make(true); 
      
   }

    public function create(){

       $course=Course::all();
       $programmes=Programme::all();
       $semesters=Semester::all();
    
    return view ('admin.courses.create')->withCourses($course)->withProgrammes($programmes)->withSemesters($semesters);

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
        
       
        $course->admin_id = Auth::guard('admin')->user()->id;

   
        $course->course_name=$request->course_name;
        $course->course_code=$request->course_code;
        $course->credits=$request->credits;
         $course->enrollment_key=Hash::make($request->enrollment_key);
        $course->description=$request->description;
        $course->room_no=$request->room_no;
        $course->building_name=$request->building_name;
        $course->save();
       $semester_id= $request->semester_id;

        $programme_id= $request->programme_id; 
      
 $course->programmes()->attach($programme_id, array('semester_id'=>$semester_id));
 
    
        Session::flash('success', 'This course was successfully created');
        return redirect()->route('admin.courses');
       
    }

    public function show($id){
       $course = Course::with("semesters","programmes","user","admin","contents.lectures", "contents.assignments", "quizes")->find($id);
    
      $course_id= $course->id;

      session()->put('course_id',$course_id);
  
      return view('admin.courses.show')->withCourse($course);
    }


     public function edit($id){
      
       $course_programme= Course_Programme::where('course_id','=', $id)->get();
     
        $course= Course::findorfail($id);
         $programmes= Programme::all();
       
    $semesters = Semester::all();
 
       return view('admin.courses.edit', compact('course', 'course_programme'))->withProgrammes($programmes)->withSemesters($semesters);
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
        $course->admin_id = Auth::guard('admin')->user()->id;
        $course->course_name=$request->course_name;
        $course->course_code=$request->course_code;
        $course->credits=$request->credits;
        $course->description=$request->description;
        $course->enrollment_key=Hash::make($request->enrollment_key);
         $course->room_no=$request->room_no;
        $course->building_name=$request->building_name;
        $course->save();
        
          // Operation on course_programme table2
      
         $semester_id= $request->semester_id;

        $programme_id= $request->programme_id;     

$course->programmes()->sync([$programme_id=>['semester_id'=>$semester_id]]);
           
        Session::flash('success', 'This course was successfully edited');
        return redirect('/admin/courses');
    }
  
  public function destroy($id)
    {
        $course= Course::findOrFail($id);
        $course->delete();

       
         return redirect('/admin/courses');
   
    }

   

}
