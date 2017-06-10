@extends('layouts.index_admin')

@section('content')
<div class="row">
<div class="col-sm-12">
<div class="well" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-10 ">
<a type="button" class="btn btn-primary" href="/admin/programmes/create"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Programme</a>
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

@endpush