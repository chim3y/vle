<?php

namespace App\Http\Controllers\student;
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
  
    public function show($contentId, $id, $lecture_name)
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
}
