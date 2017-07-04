<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;
use App\Tutor;
use App\Student;
use Hash;
use Image;
use Auth;
use App\Notifications\NewUserRegistered;


class UsersController extends Controller
{  
   

     public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('admin.users.index');
    }

     public function usersData(){
         $user= User::select(array('id','image','name','email','created_at'))->orderBy('id', 'desc');

        return Datatables::of($user)
            ->addColumn('action', function ($user) {
                $tutor=Tutor::where('user_id', $user->id)->get();
                $student=Student::where('user_id', $user->id)->get();
                return view('admin.users.partials.create', compact('user',$user ))->withStudent($student)->withTutor($tutor); 
            })
       ->editColumn('image', function ($user) {
                
                return view('admin.users.partials.image', compact('user'))->render();

            })
       ->escapeColumns([])
            ->make(true);
    }

 
    public function create(){
    	return view ('admin.users.create');
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
        $user->password=Hash::make($request->password);
        $user->created_at =$request->created_at;
        $user->updated_at= $request->updated_at;
        $user->save();
        if(isset($request->user_type)){
        if($request->user_type=="Tutor"){
            $tutor=new Tutor;
            $tutor->user_id=$user->id;
            $tutor->save();
            $user->notify(new NewUserRegistered($tutor));

        }else{
             $student=new Student;
            $student->user_id=$user->id;
            $student->save();
            $user->notify(new NewUserRegistered($student));
        }
}
       return redirect()->route('admin.users');
    }


  
     public function edit($id){
       $user= User::findorfail($id);
      
       return view('users.edit', compact('user'));
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
        return redirect('admin.users');
    }
    
    public function destroy($id)
   {
    $user = User::findOrFail($id);

    $user->delete();

    Session::flash('flash_message', 'Task successfully deleted!');

    return redirect('admin.users');
}

public function view($id, $name)
    {

        $user = User::findOrFail($id);
        return view('admin.users.view', compact('user'));
    }


}

