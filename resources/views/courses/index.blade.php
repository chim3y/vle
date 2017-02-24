@extends('layouts.index')

@section('content')
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="well" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<a type="button" class="btn btn-primary" href="/courses/create"> Add Course</a>
</div>
</div>
<br/>
<br/>
    <table class="table table-bordered table-condensed" id="courses_table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Credits</th>
                <th>Action</th>
            </tr>
        </thead>
</table>
</div>
</div>
</div>
@stop

@push('scripts')
<script>
$(function() {
    $('#courses_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
          ajax:"{{ route('coursesData') }}" ,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'users.name', orderable: false},
            { data: 'course_name', name: 'course_name', orderable: false },
            { data: 'course_code', name: 'course_code', orderable: false },
            { data: 'credits', name: 'credits', orderable: false },
            {data: 'action', name: 'action', orderable: false}
        ]
    });   
});
</script>

@endpush