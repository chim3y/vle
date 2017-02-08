@extends('layouts.index')
@section('title', 'Home | Courses')


@section('content')
<!-- Datatable -->

<div class='container'>
<button type="button">Add Course</button>
<br>

<div class="table-responsive">
<table id="courseslist" class="table table-condensed" cellspacing="0" width="100%">

<thead>
<tr>
<th> id </th>
<th> Course Name </th>
<th> Course Code </th>
<th> Programme </th>
<th> Credits </th>
<th> Start Date </th>
<th> End Date </th>
<th> Tutor </th>
<th> Action </th>
</tr>
</thead>
<tbody>
	<tr>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	</tr>
</tbody>
	
</table>
</div>
</div>

<!-- Script for Datatable -->

@push('scripts')
<script>
$(function() {
    $('#courseslist').DataTable({
        processing: true,
        serverSide: true,
         ajax: '{{ url("datatables.data") }}'
        @stack('script')
        columns: [
            { data: 'id', name: 'id' },
            { data: 'course_name', name: 'Course Name' },
            { data: 'course_code', name: 'Course Code' },
            { data: 'programme_name', name: 'Programme' },
            { data: 'credits', name: 'Credits' }
            { data: 'start_date', name: 'Start Date' },
            { data: 'end_date', name: 'End Date' },
            { data: 'tutor', name: 'Tutor' }
        ]
    });
});
</script>
@endpush