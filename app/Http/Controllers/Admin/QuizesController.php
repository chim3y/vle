<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use Yajra\Datatables\Datatables;
use Session;
use App\Quiz;
use App\Question;
use App\AttemptQuiz;
use App\Content;
use Auth;
use Illuminate\Support\Facades\Input;

class QuizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function questionsData($contentId,$id){ 
$quiz=Quiz::find($id);
$selectedquestion=$quiz->questions->pluck('id')->toArray();

Session::put('selectedquestion', $selectedquestion);


$question = Question::with("answer")->get();
            return Datatables::of($question)
            ->editColumn('use', function($question) {

        return view('admin.questions.partials.selectedquestions', compact('question',$question ))->render();
       
    })
          ->addColumn('action', function ($question) {
               return view('admin.questions.partials.editanddelete', compact('question', $question))->render();
                    
             
            })  
            ->escapeColumns([])  
           ->make(true);  
      
   }

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
        $quiz->max_attempt =$request->max_attempt;
        $quiz->course_id= session('course_id');
      $quiz->content_id=$contentId;
      $quiz->save();

$questions=Input::get('selected_questions');


foreach ($questions as $id) {
     $quiz->questions()->attach([$id]);
}

     
        return redirect('/admin/courses/'.$quiz->course_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $quiz_name)
    {
        $quiz= Quiz::with("questions.answer")->find($id);
        if(Auth::guard('admin')->check()){
     $userquiz=AttemptQuiz::where('admin_id', Auth::guard('admin')->user()->id)->where('quiz_id', $id)->latest()->first();
  
      if(!is_null($userquiz)){
        $attempt=1+$userquiz->attempt;
      }
      else{
        $attempt=1;
      }

 }
        return view('admin.quizes.show1', compact('quiz', $quiz))->withAttempt($attempt);




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contentId,$id)
    {
        $quiz= Quiz::findorfail($id);
     

       return view('admin.quizes.edit', compact('quiz',$quiz))->with('contentId', $contentId)->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contentId, $id)
    {
         $quiz=Quiz::find($id);
        $quiz->quiz_name = $request->quiz_name;
        $quiz->max_attempt =$request->max_attempt;
      $quiz->save();

$questions=Input::get('selected_questions');


$quiz->questions()->detach();

foreach ($questions as $id) {
     $quiz->questions()->attach([$id]);
}

 return redirect()->back();
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               $quiz= Quiz::findOrFail($id);
       
  

           $quiz->course_id= session('course_id');
        
 
   if(!is_null($quiz)) {
        $quiz->delete();
        }

         return redirect('/admin/courses/'.$quiz->course_id);
    }
}
