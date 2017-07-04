<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use Session;
use App\Quiz;
use App\Student;
use App\Course;
use App\AttemptQuiz;
use App\Content;
use Auth;
use Illuminate\Support\Facades\Input;

class QuizesController extends Controller
{
   
    public function show($id, $quiz_name)
    {
   
        $quiz= Quiz::with("questions.answer")->find($id);
        $uid= Auth::guard('web')->user()->id;
$student_id=Student::where('user_id', $uid)->value('id');
$student=Student::find($student_id);
$course_id= $quiz->course_id;
$course=Course::find($course_id);
$condition= $course->student->contains($student);


if (!$condition){

         Session::flash('success', 'Please enter correct enrollment key');
      return view('student.courses.enroll', compact('course',$course ))->withStudentId($student_id);
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
        return view('student.quizes.show1', compact('quiz', $quiz))->withAttempt($attempt);




    }

 
}
