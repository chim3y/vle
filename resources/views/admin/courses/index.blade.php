@extends('layouts.index_admin')
@section('title', 'Courses | All ')
@section('main_title')
<i class=" fa fa-book" aria-hidden="true"></i>  Courses
@endsection
@section('sub_title', 'All')
@section('current_page', 'All')

@section('content')
<div class="row" >
<div class="col-sm-12" style="background-color: white">

<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-10 ">
<a type="button" class="btn btn-primary" href="{{ URL::route('admin.courses.create') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Course</a>
</div>
</div>
<br/>
<br/>
    <div class="table-responsive">
    <table class="table table-bordered table-primary table-striped table-hover" id="courses_table">
        <thead style="background-color: #428bca;
    color: white;">
            <tr> 
                <th >Name</th>
                <th>Code</th>
                <th>Credits</th>
                <th>Programmes </th>
                <th>Semesters </th>
                <th>Created by </th>
                <th>Created at </th>
                <th class="col-md-2">Operations </th>
            </tr>
        </thead>
</table>
</div>
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
          ajax:"{{ route('admin.coursesData') }}" ,
        columns: [
            { data: 'course_name', name: 'course_name', orderable: false },
            { data: 'course_code', name: 'course_code', orderable: false },
            { data: 'credits', name: 'credits', orderable: false },
            {data: 'programme_name', name: 'programmes.programme_name', orderable: false },
            {data: 'semester_name', name: 'semesters.semester_name', orderable: false },
            {data:'name', name:'name', orderable:false},
            {data:'created_at', name:'created_at', orderable:false},
            {data: 'action', name: 'action', orderable: false}
        ]
    });   
});
</script>

@endpush
