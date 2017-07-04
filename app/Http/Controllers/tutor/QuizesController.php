<?php

namespace App\Http\Controllers\tutor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use Session;
use App\Quiz;
use App\Tutor;
use App\Course;
use App\AttemptQuiz;
use App\Content;
use App\QUestion;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\Input;

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
  
        return view('tutor.quizes.index', compact("quizes","contentId"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function questionsData($contentId,$id){ 
$quiz=Quiz::find($id);
$selectedquestion=$quiz->questions->pluck('id')->toArray();


Session::put('selectedquestion', $selectedquestion);


$question = Question::where(function ($query) {
    $query->where('user_id', Auth::guard('web')->user()->id)
          ->orWhereNull('admin_id')->orWhereNotNull('admin_id')
          ;

})
        ->with("answer")->get();
            return Datatables::of($question)
            ->editColumn('use', function($question) {

        return view('tutor.questions.partials.selectedquestions', compact('question',$question ))->render();
       
    })
          ->addColumn('action', function ($question) {
               return view('tutor.questions.partials.editanddelete', compact('question', $question))->render();
                    
             
            })  
            ->escapeColumns([])  
           ->make(true);  
      
   }

    public function create($contentId)
    {

        return view('tutor.quizes.create')->with('contentId', $contentId);
   
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

     
        return redirect('/tutor/courses/'.$quiz->course_id);


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
        $uid= Auth::guard('web')->user()->id;
$tutor_id=Tutor::where('user_id', $uid)->value('id');
$tutor=Tutor::find($tutor_id);
$course_id= $quiz->course_id;
$course=Course::find($course_id);
$condition= $course->tutors->contains($tutor);


if (!$condition){

         Session::flash('success', 'Please enter correct enrollment key');
      return view('tutor.courses.enroll', compact('course',$course ))->withStudentId($student_id);
  }


        if(Auth::guard('web')->check()){
     $userquiz=AttemptQuiz::where('user_id', Auth::guard('web')->user()->id)->where('quiz_id', $id)->latest()->first();
  
      if(!is_null($userquiz)){
        $attempt=1+$userquiz->attempt;
      }
      else{
        $attempt=1;
      }

 }
        return view('tutor.quizes.show1', compact('quiz', $quiz))->withAttempt($attempt);




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
    

       return view('tutor.quizes.edit', compact('quiz',$quiz ))->with('contentId', $contentId)->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequest $request, $contentId, $id)
    {
          $quiz= Quiz::find($id);
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

         return redirect('/tutor/courses/'.$quiz->course_id);
    }
}
