@extends('layouts.index')
@section('title', 'Courses | All ')
@section('main_title')
<i class=" fa fa-book" aria-hidden="true"></i>  Courses
@endsection
@section('sub_title', 'All')
@section('current_page', 'All')
@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'Student')

@section('link_dashboard')
<a href='/student/dasboard'> Dashboard </a>
@endsection
 
@section('content')
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="well" style="background-color: white"  id="one">


<br/>
<br/>
<div class="table-resonsive">
  <table class="table table-bordered table-primary table-striped table-hover" id="courses_table">
   
      <thead style="background-color: #428bca;
    color: white;">
            <tr> 
                <th id="two">Course Name</th>
                <th>Course Code</th>
                <th>Credits</th>
                <th>Programmes </th>
                <th> Semesters </th>
                <th >Operations </th>
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
$(document).ready(function() {
    var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace( /[$,]/g, '' ) :
                        data;
                }
            }
        }
    };
 
    $('#courses_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
          ajax:"{{ route('student.coursesData') }}" ,
        columns: [
            { data: 'course_name', name: 'course_name', orderable: false },
            { data: 'course_code', name: 'course_code', orderable: false },
            { data: 'credits', name: 'credits', orderable: false },
            {data: 'programme_name', name: 'programmes.programme_name', orderable: false },
            {data: 'semester_name', name: 'semesters.semester_name', orderable: false },
            {data: 'action', name: 'action', orderable: false}
        ]
    ,
        dom: 'Bfrtip',
        buttons: [
            $.extend( true, {}, buttonCommon, {
                extend: 'copyHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'pdfHtml5'
            } ),
             $.extend( true, {}, buttonCommon, {
                extend: 'print'
            } )
        ]
    } );
} );
</script>
<Script>
// Instance the tour
var tour = new Tour({
  debug: true,
  storage: false,
  steps: [
  {
 
  {
    element: "#one",
    title: "Welcome",
    content: "Hello Student, Welcome to the class",
    placement: "bottom",
     duration:4000,
    },
      {
    element: "#four",
    title: "View Course",
    content: "Click View button to view the course page",
    placement: "top",
    onShow: function() {
      return $("#aone").addClass("open");
    },      onHide: function() {
      $("#one").removeClass("open"); 
    } 
  }    
]});

if (tour.ended()) {
  tour.restart();
} else {
  tour.init();
  tour.start();
}

</Script>


@endpush
