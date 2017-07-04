<?php

namespace App\Http\Controllers\Admin;
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
use Session;
use Input;

class QuestionsController extends Controller
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

 public function questionsData(){

         $question = Question::with("answer")->get();
            return Datatables::of($question)
            ->editColumn('use', function($question) {
        return '<input type="checkbox" value='. $question->id .' name="selected_questions[]">';
    })
          ->addColumn('action', function ($question) {
               return view('admin.questions.partials.editanddelete', compact('question', $question))->render();
                    
             
            })  
            ->escapeColumns([])  
           ->make(true);  
      
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        if($type=="multiple"){
            return view('admin.questions.multiple.create')->withType($type);
        }
        elseif($type=="single"){
            return view('admin.questions.single.create')->withType($type);
        }
        elseif ($type=="fill-in-blanks"){
               return view('admin.questions.fill in blanks.create')->withType($type);
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
         $question->admin_id=Input::get('admin_id');
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


            return view('admin.questions.multiple.edit')->withType($type)->withQuestion($question);
        }
        elseif($question->type=="single"){

            return view('admin.questions.single.edit')->withType($type)->withQuestion($question);
        }
        elseif ($question->type=="fill-in-blanks"){
         
               return view('admin.questions.fill in blanks.edit')->withType($type)->withQuestion($question);
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
       $question= Question::findOrFail($id);
    
         $question->delete();

   
       return redirect()->back();
     }
}