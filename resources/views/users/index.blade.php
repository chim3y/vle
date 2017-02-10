@extends('layouts.main')


@section('content')
<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
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
    <table class="table table-bordered" id="users">
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
</div>
</div>
@stop

@push('scripts')
<script>
$(function() {
    $('#users').DataTable({
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