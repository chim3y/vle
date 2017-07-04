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
        $destinationPath =public_path('uploads/lectures/',$filename);
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
    
     public function download($file_name) {
    $file_path = public_path('uploads/lectures/'.$file_name);
    return response()->download($file_path);
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
                  $file =  base_path().'/public/uploads/lectures/'.$document_name;
                if (file_exists($file)){            
            
$ext =File::extension($file);
              
                if($ext=='pdf'){
                    $content_types='application/pdf';
                   }elseif ($ext=='doc') {
                     $content_types='application/msword';  
                   }elseif ($ext=='docx') {
                     $content_types='application/vnd.openxmlformats-officedocument.wordprocessingml.document';  
                   }elseif ($ext=='xls') {
                     $content_types='application/vnd.ms-excel';  
                   }elseif ($ext=='xlsx') {
                     $content_types='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';  
                   }elseif ($ext=='txt') {
                     $content_types='application/octet-stream';  
                   }
                   elseif ($ext=='ptt') {
                   $content_types='application/vnd.ms-powerpoint';
                   }
                  elseif ($ext=='pptx') {
                   $content_types='application/vnd.openxmlformats-officedocument.presentationml.presentation';
                   }

                  elseif ($ext=='pptx') {
                   $content_types='application/vnd.openxmlformats-officedocument.presentationml.template';
                   }
                  elseif ($ext=='mdb') {
                   $content_types='application/vnd.ms-access';
                   }


return response(file_get_contents($file),200) ->header('Content-Type',$content_types);

            }
            else{
             exit('Requested file does not exist on our server!');
            }

       }else{
         exit('No attachment');
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
        if($request->hasfile('document')){
             $destinationPath = '';
        $filename = '';
        $size = round(($request->file('document')->getSize()) / 1024, 2); //round of to 2 decimal place in KB
        $file = $request->file('document');
        $destinationPath =public_path('uploads/lectures/',$filename);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        $filename = time(). '.' .$file->getClientOriginalName();
        $file->move($destinationPath, $filename);


         $oldfilename=$lecture->document;   
          if (!empty($oldfilename)){
             File::delete('uploads/lectures/'.$oldfilename);
        }
        $lecture->document = $filename;
        }
        else{
        $lecture->document = $lecture->document;    
        }

        $lecture->save();

        
           $lecture->course_id= session('course_id');

        return redirect('/admin/courses/'.$lecture->course_id);
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
     
           $lecture->course_id= session('course_id');

    
         return redirect('/admin/courses/'.$lecture->course_id);
   
    }
}
