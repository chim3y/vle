@extends('layouts.index_admin')
@section('title', 'Programme| View')
@section('main_title')
<i class=" fa fa-graduation-cap" aria-hidden="true"></i>  Programme
@endsection
@section('sub_title', 'View')
@section('current_page')
Programme
<li> View</li>
@endsection
@section('content')
<br/>


@section('content')
<div class="row">
<div class="col-sm-12">
<div class="well" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-10 ">
<a type="button" class="btn btn-primary" href="/admin/programmes/create" id="one"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Programme</a>
</div>
</div>
<br/>
<br/>
    <table class="table table-bordered table-primary table-striped table-hover"id="programmes_table">
             <thead style="background-color:    #428bca;
    color: white;">
            <tr>
                <th>Id</th>
                <th>Programme Code</th>
                <th>Programme Name</th>
                <th>Department Name</th>
                <th>Created At</th>
                <th class="col-md-2">Operations </th>
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
    $('#programmes_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
          ajax:"{{ route('programmesData') }}" ,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'programme_code', name: 'programme_code', orderable: false},
            { data: 'programme_name', name: 'programme_name', orderable: false},
            { data: 'department.department_name', name: 'departments.department_name', orderable: false},
            { data: 'created_at', name: 'created_at', orderable: false },
            {data: 'action', name: 'action', orderable: false}
        ]
    });   
});
</script>
<Script>
// Instance the tour
var tour = new Tour({
  debug: true,
  storage: false,
  steps: [
  {
    element: "#one",
    title: "Create new Programme",
    content: "Click here to create new programme",
    placement: "left",
    duration:4000,

  },
 {
    element: "#two",
    title: "Edit Programme",
    content: "Edit the programme details by clicking here. ",
    placement: "left",
    duration:4000,
    
  },
  {
    element: "#three",
    title: "Delete Programme",
    content: "Delete the particular Programme if not needed",
    placement: "bottom",
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
