
<a type="button" class="btn btn-success" href="/admin/departments/{{$department->id}}/edit" style=" display: inline-block;
    vertical-align: top;
 "> <span class="glyphicon glyphicon-edit"></span> Edit
</a>

{{ Form::open(['method' => 'DELETE', 'route' => ['admin.departments.delete', $department->id] , 'style'=>'display: inline-block']) }}
 {!! csrf_field() !!}
<button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove"> </span>Delete</button>
</div>
{{Form::close()}}

