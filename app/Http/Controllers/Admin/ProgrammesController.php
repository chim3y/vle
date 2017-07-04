<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ProgrammeRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Course;
use App\Programme;
use App\Department;
use App\Semester;

use Auth;
class ProgrammesController extends Controller
{
   

public function __construct() {
    
    $this->middleware('auth:admin');   
}




    public function index()
    {
        
        return view('admin.programme.index');
        
    }


     public function programmesData(){

         $programme = Programme::with("department")
            ->get();
            return Datatables::of($programme)
          ->addColumn('action', function ($programme) {
               return view('admin.programme.partials.editanddelete', compact('programme'))->render();
                
             
            }) 
            ->escapeColumns([])   
           ->make(true);  
      
   }


   
    public function create(){
        $department=Department::all();
    	return view ('admin.programme.create', compact('department'));

    }

     public function store(ProgrammeRequest $request ){
        $programme = $request->all();
         Programme::create($programme);
        return redirect()->route('admin.programmes');
       
    }
  
    public function show($id){

    $programme = Programme::with('course_programme.courses.semester')->find($id);
       return view('admin.programme.show', compact('programme'));
    }


     public function edit($id){
       $programme= Programme::findorfail($id);
        $departments=Department::all();

        $deps= array();
        foreach ($departments as $department) {
            $deps[$department->id]= $department->department_name;
         }

       return view('admin.programme.edit')->withProgramme($programme)->withDepartments($deps);
    }

    public function update($id, ProgrammeRequest $request){
        $programme = Programme::findorfail($id);
        $programme->programme_code = $request->programme_code;
          $programme->programme_name= $request->programme_name;
          $programme->department_id= $request->input('department_id');  
        $programme->save();
        return redirect()->route('admin.programmes');
    }

  public function destroy($id)
    {
        $programme= Programme::findOrFail($id);
        $programme->delete();

       
         return redirect('/admin/programmes');
   
    }


}
