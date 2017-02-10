@extends('layouts.main')


@section('content')
<br/>
<br/>
<a type="button" class="btn btn-primary" href="/users/create"> Add Users</a>
<br/>
<br/>
<div class="well" style="background-color: cyan">
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
</table>
</div>
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('usersData') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'password', name: 'password' },
        ]
    });
});
</script>
@endpush