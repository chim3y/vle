

@if($course->user_id==Auth::user()->id)

<a type="button" class="btn btn-success" id="four" href="{{ URL::route('tutor.courses.show', array('id'=> $course->id)) }}" style=" display: inline-block;
    vertical-align: top;
 "> <i class="fa fa-eye"> </i> View
</a>

<a type="button" class="btn btn-success" href="/tutor/courses/{{$course->id}}/edit" style=" display: inline-block;
    vertical-align: top;
 " id="two"> <span class="glyphicon glyphicon-edit"></span> Edit
</a>

{{ Form::open(['method' => 'DELETE', 'route' => ['tutor.courses.delete', $course->id] , 'style'=>'display: inline-block']) }}
 {!! csrf_field() !!}
<button class="btn btn-danger" type="submit" id="three">Delete</button>
</div>
{{Form::close()}}
@endif
   
@if($course->user_id !=Auth::user()->id)

<a type="button" class="btn btn-success" id="four" href="{{ URL::route('tutor.courses.show', array('id'=> $course->id)) }}" style=" display: inline-block;
    vertical-align: top;
 "> <i class="fa fa-eye"> </i> View
</a>

<a type="button" class="btn btn-success disabled" href="/tutor/courses/{{$course->id}}/edit" style=" display: inline-block;
    vertical-align: top;
 " id="two"> <span class="glyphicon glyphicon-edit"></span> Edit
</a>

{{ Form::open(['method' => 'DELETE', 'route' => ['tutor.courses.delete', $course->id] , 'style'=>'display: inline-block']) }}
 {!! csrf_field() !!}
<button class="btn btn-danger disabled" type="submit" id="three">Delete</button>
</div>
{{Form::close()}}

@endif
   