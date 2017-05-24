<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use Session;
use App\Quiz;
use App\Content;

class QuizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contentId)
    {   

        $quizes= Quiz::latest('updated_at')->where("content_id", $contentId)->get();
  
        return view('admin.quizes.index', compact("quizes","contentId"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contentId)
    {
       
        return view('admin.quizes.create')->with('contentId', $contentId);
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizRequest $request, $contentId)
    {

        
        $quiz= new Quiz();
        $quiz->quiz_name = $request->quiz_name;
        $quiz->description = $request->description;
       
       foreach (session('course_id') as $course_id) {
        $quiz->course_id= $course_id;
       }
        

       $content=Content::findorfail($contentId);


      $content->quizes()->save($quiz);

       return redirect("/contents/$contentId/quizes");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contentId, $quizesId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
