@extends('layouts.index_admin')
@section('title', 'Students | All')
@section('main_title', 'Students')
@section('sub_title', 'All')
@section ('current_page', 'All')
@section ('content')

<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#sectionA" style="color: black">STUDENT PENDING APPROVAL</a></li>
<li><a href="#sectionB" style="color: black">APPROVED STUDENTS</a></li>
<li><a href="#sectionC" style="color:black">DENIED STUDENTS</li>
</ul>

<div class="tab-content">
<div id="sectionA" class="tab-pane fade in active" style="background-color: white">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<a type="button" class="btn btn-primary" href="/admin/students/create"> Add Student</a>
</div>
</div>
<br/>
<br/>
    <table class="table table-bordered table-condensed" id="pendingstudents_table">
        <thead style="background-color: #D3D3D3; font-size:15px; color:black">
            <tr>
                <th>Id</th>
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


<div id="sectionB" class="tab-pane fade" style="background-color: white">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>
<table class="table table-bordered table-condensed" id="approvedstudents_table">
         <thead style="background-color: #D3D3D3; font-size:15px; color:black">
            <tr>
                <th>Id</th>
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

<div id="sectionC" class="tab-pane fade" style="background-color: white">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>

<table class="table table-bordered table-condensed" id="deniedstudents_table">
          <thead style="background-color: #D3D3D3; font-size:15px; color:black">
            <tr>
                <th>Id</th>
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
@stop

@push('scripts')
<script>
$(function() {
    $('#pendingstudents_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.pendingstudentsData') !!}',
        columns: [
            { data: 'user.id', name: 'users.id', orderable: false   },
            { data: 'user.name', name: 'users.name', orderable: false },
            { data: 'user.email', name: 'users.email', orderable: false },
            { data: 'user.password', name: 'users.password', orderable: false },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

$(function() {
    $('#approvedstudents_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.approvedstudentsData') !!}',
        columns: [
            { data: 'user.id', name: 'users.id', orderable: false  },
            { data: 'user.name', name: 'users.name', orderable: false },
            { data: 'user.email', name: 'users.email', orderable: false },
            { data: 'user.password', name: 'users.password', orderable: false },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

$(function() {
    $('#deniedstudents_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.deniedstudentsData') !!}',
        columns: [
            { data: 'user.id', name: 'users.id', orderable: false   },
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