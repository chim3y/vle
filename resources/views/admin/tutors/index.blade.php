@extends('layouts.index_admin')
@section('title', 'Tutors | View All')
@section('main_title')
<i class=" fa fa-user" aria-hidden="true"></i>  Tutors
@endsection
@section('sub_title', 'View All')
@section ('current_page')
<li> Students </li>
<li> View All </li>
@endsection
@section ('content')
<br/>

<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#sectionA" style="color: black">TUTOR PENDING APPROVAL</a></li>
<li><a href="#sectionB" style="color: black">APPROVED TUTORS</a></li>
<li><a href="#sectionC" style="color:black">DENIED TUTORS</li>
</ul>

<div class="tab-content">
<div id="sectionA" class="tab-pane fade in active" style="background-color: white">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
 <a type="button" class="btn btn-success" href="/admin/tutors/create"> <i class=" fa fa-user" aria-hidden="true"></i> &nbsp; Add Tutor</a>
</div>
</div>
<br/>
<br/>
 <div class="table-responsive">
  <table class="table table-bordered table-primary table-striped table-hover" id="pendingtutors_table">
        <thead style="background-color: #D3D3D3; font-size:15px; color:black">
            <tr>
                <th>Image</th>
                <th>Tutor Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action </th>
            </tr>
        </thead>
</table>
</div>
</div>
</div>
</div>


<div id="sectionB" class="tab-pane fade" style="background-color: white">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>
<div class="table-responsive">
<table class="table table-bordered table-primary table-striped table-hover" id="approvedtutors_table">
         <thead style="background-color: #D3D3D3; font-size:15px; color:black">
            <tr>
                <th>Image</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Approve</th>
            </tr>
        </thead>
</table>
</div>
</div>
</div>
</div>  

<div id="sectionC" class="tab-pane fade" style="background-color: white">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>
<div class="table-responsive">
<table class="table table-bordered table-primary table-striped table-hover" id="deniedtutors_table">
          <thead style="background-color: #D3D3D3; font-size:15px; color:black">
            <tr>
                <th>Image</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action </th>
            </tr>
        </thead>
</table>
</div>
</div>
</div>
</div>
</div>
@stop

@push('scripts')
<script>
$(function() {
    $('#pendingtutors_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.pendingtutorsData') !!}',
        columns: [
            { data: 'image', name: 'image', orderable: false   },
            { data: 'user.name', name: 'users.name', orderable: false },
            { data: 'user.email', name: 'users.email', orderable: false },
            { data: 'user.password', name: 'users.password', orderable: false },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

$(function() {
    $('#approvedtutors_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.approvedtutorsData') !!}',
        columns: [
            { data: 'image', name: 'image', orderable: false  },
            { data: 'user.name', name: 'users.name', orderable: false },
            { data: 'user.email', name: 'users.email', orderable: false },
            { data: 'user.password', name: 'users.password', orderable: false },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

$(function() {
    $('#deniedtutors_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.deniedtutorsData') !!}',
        columns: [
            { data: 'image', name: 'image', orderable: false   },
            { data: 'user.name', name: 'users.name', orderable: false },
            { data: 'user.email', name: 'users.email', orderable: false },
            { data: 'user.password', name: 'users.password', orderable: false },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>
<script type="text/javascript">
$(document).ready(function(){ 
    $("#myTab a").click(function(e){
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>
@endpush