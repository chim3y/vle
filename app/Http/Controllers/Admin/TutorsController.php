<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\TutorRequest;
use Yajra\Datatables\Datatables;
use App\User;
use App\Tutor;
use App\Student;
use App\Role;
use App\Http\Requests\UserRequest;
use Hash;
use Input;
use Session;
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
              ->editColumn('image', function ($tutor) {
                
                return view('admin.tutors.partials.image', compact('tutor'))->render();

            })
            ->make(true);
    }
   public function approvedtutorsData(){
    $tutor=Tutor::with('user')->where('isApproved','=','1')->get();

return Datatables::of($tutor)
            ->addColumn('action', function ($tutor) {
                return 
               view('admin.tutors.partials.deny', compact('tutor'))->render();
            })
            ->editColumn('image', function ($tutor) {
                
                return view('admin.tutors.partials.image', compact('tutor'))->render();

            })
            ->make(true);
    }
       public function deniedtutorsData(){
    $tutor=Tutor::with('user')->where('isApproved','=','2')->get();

return Datatables::of($tutor)
            ->addColumn('action', function ($tutor) {
                return 
                view('admin.tutors.partials.approveordelete', compact('tutor'))->render();
                    
            })
            ->editColumn('image', function ($tutor) {
                
                return view('admin.tutors.partials.image', compact('tutor'))->render();

            })
            ->escapeColumns([])
            ->make(true);
    }



     public function create(Request $request, $id){
        $user = User::find($id);
       $tutor=new Tutor;
       $tutor->user_id=$user->id;
       $tutor->isApproved=1;
       $tutor->save();
        $user_id=$user->id;
       $role_id=2;
        $user->roles()->attach($user_id, array('role_id'=>$role_id));
 
      
       return redirect()->route('admin.users');
    }


  
     public function edit($id){
       $Tutor= tutor::findorfail($id);
       return view('admin.tutors.edit', compact('tutor'));

    }

   

       public function update($id, Request $request){
        $tutor = Tutor::findorfail($id);

        $tutor->isApproved=Input::get('isApproved');
   
        $tutor->save();    

         $user_id=$tutor->user_id;
          $user=User::findorfail($user_id);
       $role_id=2;
        $user->roles()->attach($user_id, array('role_id'=>$role_id));
   

   return redirect()->route('admin.tutors');
}   
    public function destroy($id)
   {
  
    $tutor=Tutor::findorfail($id);
      $user_id=$tutor->id;
       $user=User::findorfail($user_id);
       $role_id=2;
       if($user->roles->contains($role_id)){
        $user->roles()->detach($user_id, array('role_id'=>$role_id));
        }

    $tutor->delete();

    return redirect()->route('admin.users');
}


    public function deleteuser($userid)
   {

    $tutor = Tutor::where('user_id', $userid)->first();

      $user_id=$userid;
       $user=User::findorfail($user_id);
       $role_id=3;
       if($user->roles->contains($role_id)){
        $user->roles()->detach($user_id, array('role_id'=>$role_id));
       }

    $tutor->delete();

    
    Session::flash('flash_message', 'Task successfully deleted!');

     return redirect()->route('admin.tutors');
}


public function show($id)
    {

        $tutor = Tutor::findOrFail($id);
        return view('admin.tutors.show', compact('tutor'));
    }


}

