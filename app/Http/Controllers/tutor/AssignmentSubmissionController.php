<?php

namespace App\Http\Controllers\tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use App\AssignmentSubmission;
use App\Student;
use App\Tutor;
use App\Admin;
use Session;
use App\Assignment;
use App\User;
use File;
use App\Course;
use Carbon\Carbon;
use Input;
use Auth;
use App\Notifications\AssignmentSubitted;
class AssignmentSubmissionController extends Controller
{
   
 

   
    public function update(Request $request, $contentId, $assignmentId, $id)
    {
      
      $assignmentsubmission=AssignmentSubmission::find($id);
      $assignment_name=Assignment::where('id',$assignmentId)->first()->assignment_title;
      $assignmentsubmission->grade=$request->grade;
      $assignmentsubmission->graded_at=Carbon::now();
       $assignmentsubmission->feedback=$request->feedback;
     $assignmentsubmission->save();

return redirect('/tutor/contents/'.$contentId.'/assignments/'.$assignmentId.'/'.$assignment_name);
   
   }
}
