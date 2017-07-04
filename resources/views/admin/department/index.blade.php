@extends('layouts.index_admin')
@section('title', 'Department | View')
@section('main_title')
<i class=" fa fa-building" aria-hidden="true"></i>  Department
@endsection
@section('sub_title', 'View')
@section('current_page')
Department 
<li> View </li>
@endsection
@section('content')
<br/>
<div class="row">
<div class="col-sm-12">
<div class="well" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-10 ">
<a type="button" class="btn btn-primary" href="/admin/departments/create"><i class="fa fa-plus-circle" aria-hidden="true" id="one"></i> Add Department</a>
</div>
</div>
<br/>
<br/>
    <table class="table table-bordered table-primary table-striped table-hover" id="departments_table">
          <thead style="background-color:   #428bca;
    color: white;">
            <tr>
                <th>Id</th>
                <th>Department Code</th>
                <th>Department Name</th>
                <th>HOD Name</th>
                <th>Created At</th>
                 <th class="col-md-2">Action</th>
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
    $('#departments_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
          ajax:"{{ route('admin.departmentsData') }}" ,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'department_code', name: 'department_code', orderable: false },
            { data: 'department_name', name: 'department_name', orderable: false },
            { data: 'user.name', name: 'users.name', orderable: false },
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
    title: "Create new Department",
    content: "Click here to create new department ",
    placement: "left",
    duration:4000,

  },
 {
    element: "#two",
    title: "Edit Department",
    content: "Edit the department details by clicking here. ",
    placement: "left",
    duration:4000,
    
  },
  {
    element: "#three",
    title: "Delete Department",
    content: "Delete the particular Department if not needed",
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