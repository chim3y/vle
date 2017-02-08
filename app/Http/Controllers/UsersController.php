<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\User;

class UsersController extends Controller {


    public function index()

    {

        return view('users.index');

    }


    public function postusers()

    { 
    	 $users = User::select(['id', 'name', 'email', 'password'])->get();
    	 
         return Datatables::of($users)->make(true);
    }

}