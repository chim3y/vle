<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\AttemptQuiz;
use App\Answer_User;
use Session;
use App\Answer;
use App\Question;
use Carbon\Carbon;
use Auth;
use Input;
class AttemptQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $quiz_name)
    {

          $quiz= Quiz::with("questions.answer")->find($id);
      
       return view("admin.quizes.attemptquiz.create", compact('quiz', $quiz));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $quiz_name)
    {

        $attemptquiz= new AttemptQuiz;
      $attemptquiz->started_at= Input::get('started_at');
      $attemptquiz->ended_at= Carbon::now();
      $attemptquiz->quiz_id=$id;

    if(Auth::guard('admin')->check()){
    $attemptquiz->admin_id= Auth::guard('admin')->user()->id;
      $userquiz=AttemptQuiz::where('admin_id', Auth::guard('admin')->user()->id)->where('quiz_id', $id)->latest()->first();


        if(!is_null($userquiz)){
      $attemptquiz->attempt=1+$userquiz->attempt;
      }
      else {
          $attemptquiz->attempt=1;
      }
     

    }
   elseif(Auth::guard('web')->check()){
   $attemptquiz->user_id= Auth::guard('web')->user()->id; 
    $userquiz=AttemptQuiz::where('user_id', Auth::guard('user')->user()->id)->where('quiz_id', $id)->latest()->first();
        if(!is_null($userquiz)){
      $attemptquiz->attempt=1+$userquiz->attempt;
      }
      else{
          $attemptquiz->attempt=1;
      }
     
}


 $attemptquiz->save();
 $attempt_id=$attemptquiz->id;
$ans=Answer::pluck('question_id')->unique();


foreach($ans as $a){

    if(!is_null(Input::get('manswer'.$a))){

$questionid=Answer::where('id',Input::get('manswer'.$a))->latest()->first()->question_id;
$questiontype=Question::where('id', $questionid)->first()->type;

$answer_id=array_map('intval', Input::get('manswer'.$a));
$question_id=Answer::where('id',$answer_id)->latest()->first()->question_id;
$answers=Answer::where('question_id', $question_id)->where('is_correct', 1)->pluck('id')->toarray();
    

  if(count(array_intersect($answer_id, $answers))>1){
    $marks=1;
   }
   else{
     $marks=0;
   }
   
  


      $quiz= Quiz::find($id);
      if(Auth::guard('admin')->check()){
          $admin_id= Auth::guard('admin')->user()->id;
          $user_id=NULL;
       }
       else{
        $user_id= Auth::guard('web')->user()->id;
          $admin_id=NULL;
       }


         $quiz->answers()->attach($answer_id, ['question_id'=>$question_id, 'admin_id'=>$admin_id,'user_id'=>$user_id, 'marks'=>$marks, 'attempt_id'=>$attempt_id]);
      
  
     }
}


foreach($ans as $a){
 if(!is_null(Input::get('answer'.$a))){
   $answer_id=Input::get('answer'.$a);

   $question_id=Answer::where('id',$answer_id)->first()->question_id;
   $answers=Answer::where('question_id', $question_id)->where('is_correct', 1)->first();
   $answersid=$answers->id;
  if($answer_id==$answersid){
    $marks=1;
   }
   else{
    $marks=0;
   }

      $quiz= Quiz::find($id);
      if(Auth::guard('admin')->check()){
          $admin_id= Auth::guard('admin')->user()->id;
          $user_id=NULL;
       }
       else{
        $user_id= Auth::guard('web')->user()->id;
          $admin_id=NULL;
       }


         $quiz->answers()->attach($answer_id, array('question_id'=>$question_id, 'admin_id'=>$admin_id,'user_id'=>$user_id, 'marks'=>$marks, 'attempt_id'=>$attempt_id));   
  
     }
   
}

foreach($ans as $a){
 if(!empty(Input::get('ans'.$a))){
   $answer_id=Input::get('ans'.$a);
   $question_id=Answer::where('id',$answer_id)->first()->question_id;
   $answers=Answer::where('question_id', $question_id)->where('is_correct', 1)->first();
   $answersid=$answers->id;
  if($answer_id==$answersid){
    $marks=1;
   }
   else{
    $marks=0;
   }

      $quiz= Quiz::find($id);
      if(Auth::guard('admin')->check()){
          $admin_id= Auth::guard('admin')->user()->id;
          $user_id=NULL;
       }
       else{
        $user_id= Auth::guard('web')->user()->id;
          $admin_id=NULL;
       }


         $quiz->answers()->attach($answer_id, array('question_id'=>$question_id, 'admin_id'=>$admin_id,'user_id'=>$user_id, 'marks'=>$marks, 'attempt_id'=>$attempt_id));   
  
     }
}
  $course_id=Session('course_id');
     return redirect('/admin/quiz/'.$id.'/'.$quiz_name.'/attemptquiz/'.$attempt_id.'/result');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  edit($quizId,$quiz_name,$id  )
    { 
         $admin_id= Auth::guard('admin')->user()->id;
         $attempt=AttemptQuiz::where('pivot_id',$id)->where('admin_id', $admin_id)->first();
          $quiz= Quiz::with("questions.answer")->find($quizId);
          $answer=Answer::all();
 $useranswer=Answer_User::where('quiz_id', $quizId)->where('admin_id', $admin_id)->where('attempt_id', $id)->get(); 
$userpercentage = (array_sum($useranswer->pluck('marks')->toArray()) * 100)/count($quiz->questions);


       return view('admin.quizes.attemptquiz.result', compact('attempt', $attempt))->withUseranswer($useranswer)->withQuiz($quiz)->withAnswer($answer)->withUserpercentage($userpercentage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contentId, $id)
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
