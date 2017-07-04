

{!! Form::open(['action' => ['UsersController@show', 'id'=>$user->id, 'name'=>str_slug($user->name)], 'method' => 'GET', 'style'=>' display:inline-block']) !!}
    <button  type="submit" class="btn btn-info" id="view" style="color: white; font-size:14px" data-toggle="tooltip" title="click to view user details">    <strong>view</strong> <i class=" fa fa-eye" aria-hidden="true"></i></button>
 {!! Form::close() !!} 


@if($tutor->count()==0)
{!! Form::open(['action' => ['Admin\TutorsController@create', 'id'=>$user->id], 'method' => 'POST', 'style'=>' display:inline-block']) !!}
    <button  type="submit" class="btn btn-primary" id="adding" style="color:white; font-size:14px" data-toggle="tooltip" title="click to assign tutor role"> <strong>Add Tutor </strong></button>
 {!! Form::close() !!} 
@else
{!! Form::open(['action' => ['Admin\TutorsController@deleteuser', 'userid'=>$user->id], 'method' => 'DELETE', 'style'=>' display:inline-block']) !!}
    <button  type="submit" class="btn btn-primary" id="remove" style="color:white; font-size:14px" data-toggle="tooltip" title="click to remove tutor role"> <strong>Tutor </strong> <i class="fa fa-minus"> </i></button>
 {!! Form::close() !!} 
@endif


@if($student->count()==0)
{!! Form::open(['action' => ['Admin\StudentsController@create', 'id'=>$user->id], 'method' => 'POST', 'style'=>' display:inline-block']) !!}
    <button  type="submit" class="btn btn-warning" id="adding" style="color: white; font-size:14px" data-toggle="tooltip" title="click to assign student role"> <strong>add Student</strong>   </i></button>
 {!! Form::close() !!} 
 @else
{!! Form::open(['action' => ['Admin\StudentsController@deleteuser', 'userid'=>$user->id], 'method' => 'DELETE', 'style'=>' display:inline-block']) !!}
    <button  type="submit" class="btn btn-warning" id="remove" style="color:white; font-size:14px" data-toggle="tooltip" title="click to remove student role"> <strong> Student </strong> <i class="fa fa-minus"> </i></button>
 {!! Form::close() !!} 
@endif


<script type="text/javascript">
    $('#adding').click(function(){
this.form.submit();
this.disabled=true;
this.innerHTML='<i class="fa fa-spinner fa-spin"></i> Adding...';
});

</script>

<script type="text/javascript">
    $('#remove').click(function(){
this.form.submit();
this.disabled=true;
this.innerHTML='<i class="fa fa-spinner fa-spin"></i> Removing...';
});

</script>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

