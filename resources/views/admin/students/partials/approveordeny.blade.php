     


{!! Form::open(['action' => ['Admin\StudentsController@update', 'id'=>$student->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
 <input type = "hidden" name = "isApproved" value = "1">
    <button  type="submit" class="btn btn-success" style="color: white; font-size:14px">   <strong>Approve</strong></button>
 {!! Form::close() !!} 

{!! Form::open(['action' => ['Admin\StudentsController@update', 'id'=>$student->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
 <input type = "hidden" name = "isApproved" value = "2">
    <button  type="submit" class="btn btn-danger" style="color: white; font-size:14px">   <strong>Deny</strong></button>
 {!! Form::close() !!} 
