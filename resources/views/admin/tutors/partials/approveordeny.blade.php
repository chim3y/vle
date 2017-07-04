

{!! Form::open(['action' => ['Admin\TutorsController@update', 'id'=>$tutor->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
 <input type = "hidden" name = "isApproved" value = "1">
    <button  type="submit" class="btn btn-success" style="color: black; font-size:14px">   <strong>Approve</strong></button>
 {!! Form::close() !!} 

{!! Form::open(['action' => ['Admin\TutorsController@update', 'id'=>$tutor->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
 <input type = "hidden" name = "isApproved" value = "2">
    <button  type="submit" class="btn btn-danger" style="color: black; font-size:14px">   <strong>Deny</strong></button>
 {!! Form::close() !!} 

