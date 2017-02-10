@extends('layouts.main')

@section('content')
<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
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
    <table class="table table-bordered" id="courses">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Programme Code</th>
                <th>Credits</th>
                <th>Start Date </th>
                <th>End Date </th>
                <th>Description </th>
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
    $('#courses').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('coursesData') !!}',
        columns: [
            { data: 'course_name', name: 'course_name' },
            { data: 'course_code', name: 'course_code' },
            { data: 'programme_code', name: 'programme_code' },
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date'},
            { data: 'description', name: 'description'},
        ]
    });
});
</script>
@endpush