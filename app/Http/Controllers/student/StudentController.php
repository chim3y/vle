<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;
use App\Http\Requests\UserRequest;
use Hash;
use Image;
use Auth;

class StudentController extends Controller
{  
   
    public function showDashboard(){
        return view('student.dashboard');
    }



}

