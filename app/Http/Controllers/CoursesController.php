<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use \app\course;

class CoursesController extends Controller
{
    pubic function getCourses(){
    	 return view('courses.courses');
    }


    public function anyData()
{
    return Datatables::eloquent(course::query())->make(true);
}

}
