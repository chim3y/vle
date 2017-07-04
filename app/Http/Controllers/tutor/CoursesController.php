<?php

namespace App\Http\Controllers\tutor;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Course;
use App\Programme;
use App\Semester;
use App\Course_Programme;
use App\Content;
use App\User;
use App\Tutor;
use Image;
use Storage;
use Auth;
use Session;
use Hash;

class CoursesController extends Controller
{

 public function index()
    {
   
        return view('tutor.courses.index');
        
    }

public function coursesData(){
   
$course = Course::with('programmes', 'semesters')->get();


return Datatables::of($course)
            ->addColumn('action', function ($course) {
                return view('tutor.courses.partials.view', compact('course'))->render();         
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
 return $course->course_name;
           }) 
->escapeColumns([])

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
         $course->enrollment_key=Hash::make($request->enrollment_key);
        $course->description=$request->description;
        $course->save();
       $semester_id= $request->semester_id;

        $programme_id= $request->programme_id; 

 $course->programmes()->attach($programme_id, array('semester_id'=>$semester_id));
    
        Session::flash('success', 'This course was successfully created');
        return redirect()->route('tutor.courses');
  }



     public function show($id){

      $course = Course::with("semesters","programmes","user","admin","contents.lectures", "contents.assignments", "quizes")->find($id);


       $uid= Auth::guard('web')->user()->id;
        $tutor_id=Tutor::where('user_id', $uid)->value('id');
       $tutor=Tutor::find($tutor_id);
      
       $course_id= $course->id;
      session()->put('course_id',$course_id);

if (!$course->tutors->contains($tutor)){
      
      Session::flash('success', 'Please enter correct enrollment key');
      return view('tutor.courses.enroll', compact('id',$id ))->withTutorId($tutor_id);
    }
 
  return view('tutor.courses.show', compact('course',$course ));
  
}



 public function enroll(Request $request, $id){
      $this->validate($request, ['enrollment_key'=>'required']);
      $id= session('course_id');
     
      $course=Course::find($id);
       $course_id= $course->id;

      session()->put('course_id',$course_id);
      $tutor_id=$request->tutor_id;
        $tutor=Tutor::find($tutor_id);
       
        $enrollment_key= $request->enrollment_key; 

     $check=  Hash::check($enrollment_key, $course->enrollment_key);


    if($check=='true'){

    $tutor->course()->attach($id);
 
    return redirect()->route('tutor.courses.show', array('id' => $id ));
        }
    elseif($check=='false')
        
        Session::flash('success', 'Please enter correct enrollment key');
      return redirect()->route('tutor.courses.show', compact('id',$id ))->withTutorId($tutor_id);
    }




     public function edit($id){
       $programmes=Programme::all();
       $course_programme= Course_Programme::where('course_id','=', $id)->get();
     
        $course= Course::findorfail($id);
         $programmes= Programme::all();
       
    $semesters = Semester::all();
 
       return view('tutor.courses.edit', compact('course', 'course_programme'))->withProgrammes($programmes)->withSemesters($semesters);
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
            $course->enrollment_key=Hash::make($request->enrollment_key);
         $course->room_no=$request->room_no;
        $course->building_name=$request->building_name;
        $course->save();
        
          // Operation on course_programme table2
      
         $semester_id= $request->semester_id;
        $programme_id= $request->programme_id;     
 
$course->programmes()->sync([$programme_id=>['semester_id'=>$semester_id]]);

        Session::flash('success', 'This course was successfully edited');
        return redirect('/tutor/courses');
    }

  
  public function destroy($id)
    {
        $course= Course::findOrFail($id);
        $course->delete();

       
         return redirect('/tutor/courses');
   
    }
   

}
