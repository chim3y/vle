@extends('layouts.index_admin')
@section('title', 'Home | Semesters')
@section('main_title')
<i class=" fa fa-calendar-o" aria-hidden="true"></i>  Semesters
@endsection
@section('sub_title', '')
@section ('current_page', 'Semesters')

@section('content')
<div class="row">
<div class="col-md-4 col-sm-offset-1">
<br/>
<br/>

<br/>
<br/>

 <table class="table table-bordered table-primary table-striped table-hover">
	    <thead style="background-color:   #428bca;
    color: white;">
	<tr>
	<th style="text-align:center;"> Id </th>
	<th style="text-align:center;"> Semester Name </th>
	</tr>
	</thead>
	<tbody>
	  
		@foreach($semesters as $sem)
		<tr>
		<th style="text-align:center;"> {{$sem->id}} </th>
        <td style="text-align:center;"> {{$sem->semester_name}} </td>
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
