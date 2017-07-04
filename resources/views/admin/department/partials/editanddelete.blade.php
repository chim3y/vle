
<a type="button" class="btn btn-success" href="/admin/departments/{{$department->id}}/edit" style=" display: inline-block;
    vertical-align: top;
 " id="two"> <span class="glyphicon glyphicon-edit"></span> Edit
</a>

{{ Form::open(['method' => 'DELETE', 'route' => ['admin.departments.delete', $department->id] , 'style'=>'display: inline-block']) }}
 {!! csrf_field() !!}
<button class="btn btn-danger" type="submit" id="remove"><span class="glyphicon glyphicon-remove" id="three"> </span>Delete</button>
</div>
{{Form::close()}}

