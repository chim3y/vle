<?php

namespace App\Http\Controllers;
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
    
    $this->middleware('auth');   
}




    public function index()
    {
        
        return view('programme.index');
        
    }


     public function programmesData(){

         $programme = Programme::with("department")
            ->get();
            return Datatables::of($programme)
          ->addColumn('action', function ($programme) {
                return '<a href="/programmes/'.$programme->id.'/edit"> <span class="glyphicon glyphicon-edit" style="color:black"> </span> </a>';
             
            })    
           ->make(true);  
      
   }


   
    public function create(){
        $department=Department::all();
    	return view ('programme.create', compact('department'));

    }

     public function store(ProgrammeRequest $request ){
        $programme = $request->all();
         Programme::create($programme);
        return redirect('programmes');
       
    }
  
    public function show($id){

    $programme = Programme::with('course_programme.courses.semester')->find($id);
   

       return view('programme.show', compact('programme'));
    }


     public function edit($id){
       $programme= Programme::findorfail($id);
        $department=Department::all();
       return view('programme.edit', compact('programme','department'));
    }

    public function update($id, ProgrammeRequest $request){
        $programme = Programme::findorfail($id);
        $programme->update($request->all());

        return redirect('programmes');
    }


}
