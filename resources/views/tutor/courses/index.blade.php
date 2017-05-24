@extends('layouts.index_tutor')
@section('title', 'Courses | All ')
@section('main_title', 'Courses')
@section('sub_title', 'All')
@section('current_page', 'All')
@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'Tutor')

@section('link_dashboard')
<a href='/tutor/dasboard'> Dashboard </a>
@endsection
 
@section('content')
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="well" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<a type="button" class="btn btn-primary" href="{{ URL::route('tutor.courses.create') }}"> Add Course</a>
</div>
</div>
<br/>
<br/>
    <table class="table table-bordered table-condensed" id="courses_table">
        <thead>
            <tr> 
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Credits</th>
                <th>Programmes </th>
                <th> Semesters </th>
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
          ajax:"{{ route('tutor.coursesData') }}" ,
        columns: [
            { data: 'course_name', name: 'course_name', orderable: false },
            { data: 'course_code', name: 'course_code', orderable: false },
            { data: 'credits', name: 'credits', orderable: false },
            {data: 'programme_name', name: 'programmes.programme_name', orderable: false },
            {data: 'semester_name', name: 'semesters.semester_name', orderable: false },
            {data: 'action', name: 'action', orderable: false}
        ]
    });   
});
</script>

@endpush
