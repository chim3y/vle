@extends('layouts.index_admin')
@section('title', 'Users | All')
@section('main_title', 'Users')
@section('sub_title', 'All')
@section ('current_page', 'All')
@section ('content')

@section('content')


<div class="tab-content">
<div id="sectionA" class="tab-pane fade in active" style="background-color: white">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<a type="button" class="btn btn-primary" id="create" href="/admin/users/create" data-toggle="tooltip" title="create users"> Create Users</a>
</div>
</div>
<br/>
<br/>
    <table class="table table-bordered table-condensed" id="users_table">
        <thead style="background-color: #D3D3D3; font-size:15px; color:black">
            <tr>
                <th>Image</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action </th>
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
    $('#users_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.usersData') !!}',
        columns: [
            { data: 'image', name: 'image', orderable: true   },
            { data: 'name', name: 'name', orderable: false },
            { data: 'email', name: 'email', orderable: false },
            { data: 'created_at', name: 'created_at', orderable: false },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});


</script>

<script type="text/javascript">
    $('#create').click(function(){
this.form.submit();
this.disabled=true;
this.innerHTML='<i class="fa fa-spinner fa-spin"></i> Creating...';
});

</script>



@endpush