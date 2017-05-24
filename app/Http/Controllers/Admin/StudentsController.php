<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StudentRequest;
use Yajra\Datatables\Datatables;
use App\User;
use App\Tutor;
use App\Student;
use App\Http\Requests\UserRequest;
use Hash;
use Image;
use Auth;

class StudentsController extends Controller
{  
   

     public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('admin.students.index');
    }

public function pendingstudentsData(){
    $student=Student::with('user')->where('isApproved','=','0')->get();

return Datatables::of($student)
            ->addColumn('action', function ($student) {
                return view('admin.students.partials.approveordeny', compact('student'))->render();

            })
            ->make(true);
    }
   public function approvedstudentsData(){
    $student=Student::with('user')->where('isApproved','=','1')->get();

return Datatables::of($student)
            ->addColumn('action', function ($student) {
                return 
                '<a class="btn btn-primary"> 
                 <span class="glyphicon glyphicon-edit" style="color:white"> </span> 
                 </a>'; 
            })
            ->make(true);
    }
       public function deniedstudentsData(){
    $student=Student::with('user')->where('isApproved','=','2')->get();

return Datatables::of($student)
            ->addColumn('action', function ($student) {
                return 
                '<form action="{{ route(\'admin.students.update\', $tutor->id)}}" method="PATCH"> 
                    <input type = "hidden" name = "isApproved" value = "1">
                    <button type="submit" class="btn btn-primary" style="color:white">    <strong>Approve</strong>  </button>
                       
                        </input>
                    </form>
                    <form action="{{ route(\'admin.students.update\', $tutor->id)}}" method="PATCH"> 
                    <input type = "hidden" name = "isApproved" value="2">
                      <button type="submit" class="btn btn-primary" style="color:white">  <strong>Deny</strong>  </button>
                       
                    </input>
                    </form>
                    ';
            })
            ->make(true);
    }

    public function create(){
    	return view ('admin.students.create');
    }

     public function store(UserRequest $request){
        $user = new User;
        if($request->hasfile('image')){
        $image=$request->file('image');
        $filename=time(). '.' .$image->getClientOriginalExtension();
        $location=public_path('images/users'.$filename);
        Image::make($image)->resize(100, 100)->save($location);
        $user->image=$filename;
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=hash::make($request->password);
        $user->created_at =$request->created_at;
        $user->updated_at= $request->updated_at;
        $user->save();

       return redirect('admin.students');
    }


  
     public function edit($id){
       $user= User::findorfail($id);
      
       return view('admin.students.edit', compact('user'));
    }

    public function update($id, UserRequest $request){
        $user = User::findorfail($id);
         if($request->hasfile('image')){
        $image=$request->file('image');
        $filename=time(). '.' .$image->getClientOriginalExtension();
        $location=public_path('images/users'.$filename);
        Image::make($image)->resize(100, 100)->save($location);
        $user->image=$filename;
        }
        $user->update($request->all());

        return redirect('admin.students');
    }
    
    public function destroy($id)
   {
    $user = User::findOrFail($id);

    $user->delete();

    Session::flash('flash_message', 'Task successfully deleted!');

    return redirect('admin.students');
}

public function show($id)
    {

        $user = User::findOrFail($id);
        return view('admin.students.show', compact('user'));
    }


}

