<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{  
   


    const Student='student';
    const Tutor='tutor';

    public static $user_type = [
        self::Student=>'student',
        self::Tutor=>'tutor',
    ];

    public function isStudent ()
    {
        return $this->user_type == self::Student;
    }

    public function isTutor()
    {
        return $this->user_type == self::Tutor;
    }

    public function index()
    {
        return view('users.index');
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
    	return view ('users.create');
    }

     public function store(UserRequest $request){
       $input = $request->all();
       $users= User::create($input); 
       return redirect('users');
    }


  
     public function edit($id){
       $user= User::findorfail($id);
      
       return view('users.edit', compact('user'));
    }

    public function update($id, UserRequest $request){
        $user = User::findorfail($id);
        $user->update($request->all());
        return redirect('users');
    }
    
    public function destroy($id)
   {
    $user = User::findOrFail($id);

    $user->delete();

    Session::flash('flash_message', 'Task successfully deleted!');

    return redirect('users');
}

public function show($id)
    {

        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }


}

