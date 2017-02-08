@extends('layouts.index')
@section('title', 'Home | Users')
@section('main_title', 'USERS')
@section('current_page', 'Users')


@section('content')

<table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <tr>  
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            </tr>
        </tbody>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('postusers') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'password', name: 'password' }
        ]
    });
});
</script>
  <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- App scripts -->
@endpush