<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;
use App\Tutor;
use App\Student;
use App\Http\Requests\UserRequest;
use Hash;
use Image;
use Auth;

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
         $user= User::select(array('id','name','email','password'));
        return Datatables::of($user)
            ->addColumn('action', function ($user) {
                return 
                '<a href="/users/'.$user->id.'/edit" class="btn btn-primary"> 
                 <span class="glyphicon glyphicon-edit" style="color:white"> </span> 
                 </a> '; 
            })
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

       return redirect('admin.users');
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

public function show($id)
    {

        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }


}

