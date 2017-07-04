
<a type="button" class="btn btn-success" href="/admin/courses/{{$course->id}}/edit" style=" display: inline-block;
    vertical-align: top;
 " id="two"> <span class="glyphicon glyphicon-edit"></span> Edit
</a>

{{ Form::open(['method' => 'DELETE', 'route' => ['admin.courses.delete', $course->id] , 'style'=>'display: inline-block']) }}
 {!! csrf_field() !!}
<button class="btn btn-danger" type="submit" id="three"><span class="glyphicon glyphicon-remove"> </span>Delete</button>
</div>
{{Form::close()}}


   