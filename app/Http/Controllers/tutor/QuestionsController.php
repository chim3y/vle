<?php

namespace App\Http\Controllers\tutor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use Yajra\Datatables\Datatables;
use App\Question;
use App\Answer;
use Image;
use Storage;
use Auth;
use Hash;
use Input;
use Session;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
 public function questionsData(){


$question = Question::where(function ($query) {
    $query->where('user_id', Auth::guard('web')->user()->id)
          ->orWhereNull('admin_id')->orWhereNotNull('admin_id')
          ;

})
        ->with("answer")->get();
            return Datatables::of($question)
            ->editColumn('use', function($question) {
        return '<input type="checkbox" value='. $question->id .' name="selected_questions[]">';
    })
          ->addColumn('action', function ($question) {
               return view('tutor.questions.partials.editanddelete', compact('question', $question))->render();
                    
             
            }) 
            ->escapeColumns([])   
           ->make(true);  
      
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type )
    {

        if($type=="multiple"){


            return view('tutor.questions.multiple.create')->withType($type);
        }
        elseif($type=="single"){

            return view('tutor.questions.single.create')->withType($type);
        }
        elseif ($type=="fill-in-blanks"){
         
               return view('tutor.questions.fill in blanks.create')->withType($type);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request, $type)
    {

          
       $question=new Question;
       $question->question=$request->question;
       $question->type=$type;
       $question->user_id=Input::get('user_id');
       $question->save();
       
  $answer=new Answer;
  $answer->answer=$request->answer[0];

  if (isset($request->is_correct0)) {
   $answer->is_correct= 1;     //...
    }
    else{ $answer->is_correct=0; }

   $answer->question_id=$question->id;
  $answer->save();

  $answer=new Answer;
  $answer->answer=$request->answer[1];

 if (isset($request->is_correct1)) {
   $answer->is_correct= 1;   //...
    }
  else{ $answer->is_correct=0; }
   $answer->question_id=$question->id;
   $answer->save();

    $answer=new Answer;
  $answer->answer=$request->answer[2];
   if (isset($request->is_correct2)) {
   $answer->is_correct= 1;   //...
    }
  else{ $answer->is_correct=0; }
  
   $answer->question_id=$question->id;
   $answer->save();

 $answer=new Answer;
  $answer->answer=$request->answer[3];
   if (isset($request->is_correct3)) {
   $answer->is_correct= 1;    //...
    }
  else{ $answer->is_correct=0; }
  
   $answer->question_id=$question->id;
  $answer->question_id=$question->id;
  $answer->save();

$back = Input::get('back');


return redirect($back);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $question=Question::with("answer")->find($id);
$type=$question->type;

          if($question->type=="multiple"){


            return view('tutor.questions.multiple.edit')->withType($type)->withQuestion($question);
        }
        elseif($question->type=="single"){

            return view('tutor.questions.single.edit')->withType($type)->withQuestion($question);
        }
        elseif ($question->type=="fill-in-blanks"){
         
               return view('tutor.questions.fill in blanks.edit')->withType($type)->withQuestion($question);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question= Question::find($id);
       $question->question=$request->question;
       $question->save();

$answer=Answer::where('question_id', $id)->get();
foreach ($answer as $ansq){

$ansq->answer=$request->answer;
foreach($answer as $ans){
  $ansq->answer=$ans;
  }
  foreach ($request->is_correct as $correct) {
    $ansq->is_correct=$correct;
}


   $ansq->question_id=$question->id;
  $ansq->save();

  }
$back = Input::get('back');


return redirect($back);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      

       $question= Question::findOrFail($id);
    
         $question->delete();

   
       return redirect()->back();
   
}
}