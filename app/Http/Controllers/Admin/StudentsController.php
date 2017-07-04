<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use Yajra\Datatables\Datatables;
use App\User;
use App\Tutor;
use App\Student;
use App\Http\Requests\UserRequest;
use Hash;
use Image;
use Input;
use Session;
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
             ->editColumn('image', function ($student) {
                
                return view('admin.students.partials.image', compact('student'))->render();

            })
            ->escapeColumns([])
            ->make(true);
    }
   public function approvedstudentsData(){
    $student=Student::with('user')->where('isApproved','=','1')->get();

return Datatables::of($student)
            ->addColumn('action', function ($student) {
                return view('admin.students.partials.deny', compact('student'))->render();
            })
              ->editColumn('image', function ($student) {
                
                return view('admin.students.partials.image', compact('student'))->render();

            })
            ->make(true);
    }
       public function deniedstudentsData(){
    $student=Student::with('user')->where('isApproved','=','2')->get();

return Datatables::of($student)
            ->addColumn('action', function ($student) {
               
                   return view('admin.students.partials.approveordelete', compact('student'))->render();
            })
              ->editColumn('image', function ($student) {
                
                return view('admin.students.partials.image', compact('student'))->render();

            })
            ->make(true);
    }


     public function store(UserRequest $request){
        $user = new Student;
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

       return redirect()->route('admin.students');
    }

   public function create($id, Request  $request){
      $user=User::findorfail($id);

      $student=new Student;
      $student->user_id=$id;
      $student->isApproved=1;

       $student->save();
        $user_id=$user->id;
       $role_id=3;
        $user->roles()->attach($user_id, array('role_id'=>$role_id));
 
       return redirect()->route('admin.users');
    }

  
     public function edit($id){
       $user= Student::findorfail($id);
      
       return view('admin.students.edit', compact('user'));
    }

    public function update($id, Request $request){
        $student = Student::findorfail($id);

        $student->isApproved=Input::get('isApproved');
   
        $student->save();
     
      $user_id=$student->user_id;
       $user=User::findorfail($user_id);
       $role_id=3;
        $user->roles()->attach($user_id, array('role_id'=>$role_id));
 
        return redirect()->route('admin.students');
    }
    
    public function destroy($id)
   {
    $student=Student::findorfail($id);
      $user_id=$student->id;
       $user=User::findorfail($user_id);
       $role_id=3;
       if($user->roles->contains($role_id)){
        $user->roles()->detach($user_id, array('role_id'=>$role_id));
       }

    $student->delete();

    
    Session::flash('flash_message', 'Task successfully deleted!');

     return redirect()->route('admin.users');
}

    public function deleteuser($userid)
   {
    $student=Student::where('user_id', $userid);
      $user_id=$userid;
       $user=User::findorfail($user_id);
       $role_id=3;
       if($user->roles->contains($role_id)){
        $user->roles()->detach($user_id, array('role_id'=>$role_id));
       }

    $student->delete();

    
    Session::flash('flash_message', 'Task successfully deleted!');

     return redirect()->route('admin.students');
}


public function show($id)
    {

        $user = Student::findOrFail($id);

        return view('admin.students.show', compact('user'));
    }


}

