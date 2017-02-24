<?php

namespace App\Http\Controllers;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Department;
use App\Tutor;

class DepartmentsController extends Controller
{
	public function __construct() {
    
    $this->middleware('auth');
   
}

    public function index()
    {
        
        return view('department.index');
        
    }


     public function departmentsData(){

         $department = Department::with("tutor")
            ->get();
            return Datatables::of($department)
            ->addColumn('action', function ($department) {
                return '<a href="/departments/'.$department->id.'/edit"> <span class="glyphicon glyphicon-edit" style="color:black"> </span> </a>';
             
            }) 
           ->make(true);  
      
   }


   
    public function create(){
        $tutors=Tutor::all();
    	return view ('department.create', compact('tutors'));

    }

     public function store(DepartmentRequest $request ){
        $department = $request->all();
        Department::create($department);
        return redirect('departments');
       
    }
    public function show($id){
       $department= Department::find($id);
       return $department;
    }


     public function edit($id){
       $department= Department::findorfail($id);
       $tutors=Tutor::all();
       return view('department.edit', compact('department', 'tutors'));
    }

    public function update($id, DepartmentRequest $request){
        $department = Department::findorfail($id);
        $department->update($request->all());

        return redirect('departments');
    }

}





   








