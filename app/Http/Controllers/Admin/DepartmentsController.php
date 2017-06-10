<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Department;
use App\Tutor;

class DepartmentsController extends Controller
{
	public function __construct() {
    
    $this->middleware('auth:admin');
   
}

    public function index()
    {
        
        return view('admin.department.index');
        
    }


     public function departmentsData(){

         $department = Department::with("tutor","user")->get();
       
            return Datatables::of($department)
            ->addColumn('action', function ($department) {
                
                  return view('admin.department.partials.editanddelete', compact('department'))->render();
             
            }) 
           ->make(true);  
      
   }


   
    public function create(){
        $tutors=Tutor::with('user')->where('isApproved','=','1')->get();
    	return view ('admin.department.create', compact('tutors'));

    }

     public function store(DepartmentRequest $request ){
        $department= new Department;
        $department->department_code = $request->department_code;
         $department->department_name = $request->department_name;
          $department->user_id = $request->user_id;
      $department->save();
        return redirect('/admin/departments');
       
    }
    public function show($id){
       $department= Department::find($id);
       return $department;
    }


     public function edit($id){
       $department= Department::findorfail($id);
       $tutors=Tutor::with('user')->where('isApproved','=','1')->get();
       return view('admin.department.edit', compact('department', 'tutors'));

    }

    public function update($id, DepartmentRequest $request){
        $department = Department::findorfail($id);
         $department->department_code = $request->department_code;
         $department->department_name = $request->department_name;
          $department->user_id = $request->user_id;
         $department->save();

        return redirect('/admin/departments');
    }

      public function destroy($id)
    {
        $department= Department::findOrFail($id);
        $department->delete();

       
         return redirect('/admin/departments');
   
    }

}





   








