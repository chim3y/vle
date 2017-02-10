<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Requests\CreateCourseRequest;
use Yajra\Datatables\Datatables;
use App\Course;

class CoursesController extends Controller
{

    public function index()
    {
        return view('courses.index');
        
    }


     public function coursesData(){
         $course=Course::select(array('course_name','course_code','programme_code','credits', 'start_date', 'end_date', 'description'));
        return Datatables::of($course)->make('true');
    }


   
    public function create(){
    	return view ('courses.create');
    }

     public function store(CreateCourseRequest $request ){
        $input = $request->all();
        course::create($input);

    	return redirect('courses');
    }
}
