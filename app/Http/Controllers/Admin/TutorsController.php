<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\TutorRequest;
use Yajra\Datatables\Datatables;
use App\User;
use App\Tutor;
use App\Student;
use App\Role;
use App\Http\Requests\UserRequest;
use Hash;
use Image;
use Auth;

class TutorsController extends Controller
{  
   

     public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('admin.tutors.index');
    }


   public function pendingtutorsData(){
    $tutor=Tutor::with('user')->where('isApproved','0')->get();

return Datatables::of($tutor)
            ->addColumn('action', function ($tutor) {
                return 
                    view('admin.tutors.partials.approveordeny', compact('tutor'))->render();
            })
            ->make(true);
    }
   public function approvedtutorsData(){
    $tutor=Tutor::with('user')->where('isApproved','=','1')->get();

return Datatables::of($tutor)
            ->addColumn('action', function ($user) {
                return 
                '<a class="btn btn-primary"> 
                 <span class="glyphicon glyphicon-edit" style="color:white"> </span> 
                 </a>'; 
            })
            ->make(true);
    }
       public function deniedtutorsData(){
    $tutor=Tutor::with('user')->where('isApproved','=','2')->get();

return Datatables::of($tutor)
            ->addColumn('action', function ($tutor) {
                return 
                '<form action="{{ route(\'admin.tutors.update\', $tutor->id)}}" method="PATCH"> 
                    <input type = "hidden" name = "isApproved" value = "1">
                    <button type="submit" class="btn btn-primary" style="color:white">    <strong>Approve</strong>  </button>
                       
                        </input>
                    </form>
                    <form action="{{ route(\'admin.tutors.update\', $tutor->id)}}" method="PATCH"> 
                    <input type = "hidden" name = "isApproved" value="2">
                      <button type="submit" class="btn btn-primary" style="color:white">  <strong>Deny</strong>  </button>
                       
                    </input>
                    </form>
                    ';
            })
            ->make(true);
    }

    public function create(){
    	return view ('admin.tutors.create');
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

       return redirect('admin.tutors');
    }


  
     public function edit($id){
       $tutor= Tutor::findorfail($id);
      
       return view('admin.tutors.edit', compact('tutor'));

    }

   

    public function update($id, TutorRequest $request)
   {

  
    $tutor = Tutor::findOrFail($id);
     $data = Input::all();


     if(isset($data['approve'])){
         $tutor->isApproved= $request->Input::get('isApproved');

    $tutor->save();
    }
    if(isset($data['deny'])){
          $tutor->isApproved= $request->Input::get('isApproved');

    $tutor->save();
    }

  
      

   return redirect()->route('admin.tutors');
}   
    public function destroy($id)
   {


    $tutor = Tutor::findOrFail($id);

    $tutor->delete();

   
   return redirect()->route('admin.tutors');
}

public function show($id)
    {

        $tutor = Tutor::findOrFail($id);
        return view('admin.tutors.show', compact('tutor'));
    }


}

