@extends('layouts.index')


@section('content')
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="well" style="background-color: white">
<br/>
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<a type="button" class="btn btn-primary" href="/users/create"> Add Users</a>
</div>
</div>
<br/>
<br/>
    <table class="table table-bordered table-condensed" id="users_table">
        <thead>
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
@stop

@push('scripts')
<script>
$(function() {
    $('#users_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('usersData') !!}',
        columns: [
            { data: 'id', name: 'id', orderable: true   },
            { data: 'name', name: 'name', orderable: false },
            { data: 'email', name: 'email', orderable: false },
            { data: 'password', name: 'password', orderable: false },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>

@endpush