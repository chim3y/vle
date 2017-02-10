<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;
use App\Http\Requests\CreateUserRequest;

class UsersController extends Controller
{

    public function index()
    {
        return view('users.index');
    }

     public function usersData(){
         $user= User::select(array('id','name','email','password'));
        return Datatables::of($user)->make('true');
    }


    public function create(){
    	return view ('users.create');
    }

     public function store(CreateUserRequest $request){
       $input = $request->all();
       $users= User::create($input);
       return redirect('users');
    }
}

