@extends('layouts.index_admin')

@section('content')
<div class="row">
<div class="col-sm-12">
<div class="well" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-10 ">
<a type="button" class="btn btn-primary" href="/admin/departments/create"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Department</a>
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

@endpush