@extends('layouts.index')
@section('title', 'Home | Semesters')
@section('main_title', 'Semesters')
@section('sub_title', '')
@section ('current_page', 'Semesters')

@section('content')
<div class="row">
<div class="col-md-4 col-sm-offset-1">
<br/>
<br/>
<div class="row">
<div class="col-sm-4 col-sm-offset-1">
<a type="button" class="btn btn-primary" href="/courses/create"> Add Course</a>
</div>
</div>
<br/>
<br/>

 <table class="table table-bordered table-condensed">
	<thead>
	<tr>
	<th> Id </th>
	<th> Semester Name </th>
	</tr>
	</thead>
	<tbody>
	  
		@foreach($semesters as $sem)
		<tr>
		<th> {{$sem->id}} </th>
        <td> {{$sem->semester_name}} </td>
        </tr>
		@endforeach
		
	</tbody>
</table>
</div>

<div class="col-sm-3">
<div class="well">
{!! Form::open(['route'=>'semesters.store', 'method'=>'POST']) !!}
<h2> New Semester </h2>
 {!! Form::label('semester_name','Semester Name',['class'=>'control-label']) !!}
 {!! Form::text('semester_name',null, ['class'=>'form-control']) !!}
 <br/>
 {!! Form::submit('Create New Semester',['class'=>'btn btn-primary btn-block']) !!}
 <br/>
{!! Form::close()!!}
@if($errors->any())
    <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li> {{ $error}} </li>
    @endforeach
    </ul>
@endif
</div>
</div>

</div>
@stop
