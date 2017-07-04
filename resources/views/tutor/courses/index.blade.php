@extends('layouts.index_tutor')
@section('title', 'Courses | View All')
@section('main_title')
<i class=" fa fa-book" aria-hidden="true"></i>  Courses
@endsection
@section('sub_title', 'View All')
@section('current_page')
Course
<li> View All </li>

@endsection
@section('role', 'Tutor')

@section('link_dashboard')
<a href='/tutor/dasboard'> Dashboard </a>
@endsection
 
@section('content')
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="col-sm-12" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-10 ">
<a type="button" class="btn btn-primary" href="{{ URL::route('tutor.courses.create') }}" id="one">  <i class="fa fa-plus-circle" aria-hidden="true"></i>Add Course</a>
</div>
</div>


<br/>
<br/>
   <div class="table-responsive">
    <table class="table table-bordered table-primary table-striped table-hover" id="courses_table">
        <thead style="background-color: #428bca;
    color: white;">
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Credits</th>
                <th>Programmes </th>
                <th> Semesters </th>
                <th>Operations</th>
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
          ajax:"{{ route('tutor.coursesData') }}" ,
        columns: [
            { data: 'course_name', name: 'course_name', orderable: false },
            { data: 'course_code', name: 'course_code', orderable: false },
            { data: 'credits', name: 'credits', orderable: false },
            {data: 'programme_name', name: 'programmes.programme_name', orderable: false },
            {data: 'semester_name', name: 'semesters.semester_name', orderable: false },
            {data: 'action', name: 'action', orderable: false}
        ],
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
    element: "#one",
    title: "Create new course",
    content: "Click here to create new Course",
    placement: "left",
    duration:4000,

  },
 {
    element: "#two",
    title: "Edit Course",
    content: "Edit the course details by clicking here. ",
    placement: "left",
    duration:4000,
    
  },
  {
    element: "#three",
    title: "Delete Course",
    content: "Delete the particular course if not needed",
    placement: "bottom",
     duration:4000,
    },
      {
    element: "#four",
    title: "View Course",
    content: "View the particular course page",
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
<script>
    $('#remove').click(function(){
this.form.submit();
this.disabled=true;
this.innerHTML='<i class="fa fa-spinner fa-spin"></i> Removing...';
});
</script>
@endpush