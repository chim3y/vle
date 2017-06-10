<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LectureRequest;
use Session;
use App\Lecture;
use File;



class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    
    public function create($contentId)
    {    
        return view('admin.lectures.create', compact('contentId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LectureRequest $request, $contentId)
    {
        $lecture = new Lecture;
        if($request->hasfile('document')){
        $destinationPath = '';
        $filename = '';
        $size = round(($request->file('document')->getSize()) / 1024, 2); //round of to 2 decimal place in KB
        $file = $request->file('document');
        $destinationPath =public_path('uploads',$filename);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        $filename = time(). '.' .$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $lecture->document = $filename;
        }
        else{
            $lecture->document = $lecture->document; 
        }
        $lecture->lecture_name= $request->lecture_name;
        $lecture->description = $request->description;
        
        $lecture->content_id  = $contentId;

    
          $lecture->course_id= session('course_id');
     
    
         $lecture->save();

        return redirect('/admin/courses/'.$lecture->course_id);
       } 
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $lecture_name)
    {
        $lectures = Lecture::find($id);

         $document_name = $lectures->document;
              
         if(! empty($document_name)){
                  $file =  base_path().'/public/uploads/'.$document_name;
                if (file_exists($file)){

                   $ext =File::extension($file);
                  
                    if($ext=='pdf'){
                        $content_types='application/pdf';
                       }elseif ($ext=='doc') {
                         $content_types='application/msword';  
                       }elseif ($ext=='docx') {

                           return view('admin.lectures.show', compact('lectures'));  
                       }elseif ($ext=='xls') {
                         $content_types='application/vnd.ms-excel';  
                       }elseif ($ext=='xlsx') {
                         $content_types='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';  
                       }elseif ($ext=='txt') {
                         $content_types='application/octet-stream';  
                       }
                       
                   
                    return response(file_get_contents($file),200)
                           ->header('Content-Type',$content_types);
                                                            
                }
                else{
                 exit('Requested file does not exist on our server!');
                }

           }else{
             exit('Invalid Request');
           } 
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contentId, $id)
    {
        $lecture= Lecture::findorfail($id);
     
       return view('admin.lectures.edit', compact('lecture'))->with('contentId', $contentId)->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LectureRequest $request, $contentId, $id)
    {
         $lecture = Lecture::findorfail($id);
        $lecture->lecture_name = $request->lecture_name;
        $lecture->description = $request->description;
        $lecture->content_id=$contentId;
        $lecture->save();

         foreach (session('course_id') as $course_id) {
           $lecture->course_id= $course_id;
        return redirect('/admin/courses/'.$lecture->course_id);
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $lecture= Lecture::findOrFail($id);
        if(!is_null($lecture)) {
        $lecture->delete();
        }
        foreach (session('course_id') as $course_id) {
           $lecture->course_id= $course_id;

        }
         return redirect('/admin/courses/'.$lecture->course_id);
   
    }
}
