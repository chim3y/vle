{{ Form::model($tutor,['files'=>'true','method' => 'PATCH', 'route' => ['admin.tutors.update', $tutor->id], 'style'=>'display: inline-block']) }}
<meta name="csrf-token" content="{{ csrf_token() }}" /> 
 <input type="hidden" name="id" value="{{ $tutor->id }}" >

<input type = "hidden" name = "isApproved" value = '1'></input> 
<button type="submit" class="btn btn-primary" style="color:white" name="Approve" > 
  <strong>Approve</strong>  
</button>



 <input type="hidden" name="id" value="{{ $tutor->id }}" >
<input type = "hidden" name = "isApproved" value = '2'></input>
<button type="submit" class="btn btn-primary" style="color:white" name="deny">  <strong>Deny</strong>  </button>

{{ Form::close() }}



