@extends('layouts.index')
@section('title', 'Courses')
@section('main_title', 'Courses')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section('stylesheets')
{!!Html::style('/css/button_hover.css')!!}
@endsection
@section ('content')
<br/>

<div class="row">
<div class="col-sm-10 col-sm-offset-1">

<div class="row">
<div class="panel panel-primary" style="border: 0;">
<div class="panel-heading">
<div class="row">
<div class="col-sm-2">
<img src="{{ asset('images/courses/'.$course->image) }}" class="img-responsive" height="150" width="150" />
</div>
<div class="col-sm-10">
<h2> <b> {{ \Illuminate\Support\Str::upper($course->course_name) }} </b> </h2>
</div>
</div>
</div>


<div class="panel-body">
<div class="row">
<div class="col-sm-2">
<img src="{{asset('images/users/'.$course->user->image) }}" class="img-circle img-responsive" width="150" height="150" />
</div>
<div class="col-sm-8 col-sm-offset-2" style="font-size:16px">
<br/>
<br/>
 <strong> Taught by: </strong> <b> {{ucfirst($course->user->name)}} </b> 
</div>
</div>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" style="font-size: 16px">
<table class="table table-bordered table-condensed" style="border: 1px solid black" >

	<tr>
	<th class="col-md-4" style="border: 1px solid black; text-align: center"> <span class="glyphicon glyphicon-time"> </span>&nbsp; Commitments:  </th>
	
	<td style="border: 1px solid black; text-align: center"> </td>

	</tr>
	<tr>
	<th class="col-md-4" style="border: 1px solid black; text-align: center"> <span class="glyphicon glyphicon-calendar"> </span> &nbsp; Semesters: </th>	
	<td style="border: 1px solid black; text-align: center">
	
	@foreach($course->semesters as $semester)
	@foreach($course->programmes as $programme)
  <a href="#" data-toggle="tooltip" data-placement="bottom" style="color:inherit" title="Programme Name:{{$programme->programme_name}}"> 
  {{$semester->semester_name}} 
  </a>.
 @endforeach
 @endforeach
 </td>
 </tr>
 <tr>
<th class="col-md-4" style="border: 1px solid black; text-align: center"> <span class="glyphicon glyphicon-check"></span> &nbsp; Credits:  </th>
<td style="border: 1px solid black; text-align: center"> {{$course->credits}} </td>
</tr>
</table>
</div>
</div>


<div class="row">
<div class="container">

<div class="row">
<div class="col-sm-8 col-sm-offset-2">
<h3> Content </h3>
</div>
</div>
@foreach($course->contents as $content)
<div class="row">
<div class="col-sm-1 col-sm-offset-1"> <h4 style="display:inline-block"> <strong> <kbd> {{ \Illuminate\Support\Str::upper($content->name) }} </kbd> </strong> </h4> 
</div>
<div class="col-sm-4">

{!! Form::open(['action' => ['ContentController@edit', $content->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link edit" name="edit" id="edit" style="color:black; font-size:14px">  edit  </button> 
 {!! Form::close() !!} 

{!! Form::open(['action' => ['ContentController@destroy', $content->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link delete" style="color: black; font-size:14px"> delete </button>
 {!! Form::close() !!}   

<div class="dropdown" style="display:inline-block">
<button class="create btn btn-link dropdown-toggle" id="menu1" data-toggle="dropdown" style="color: black; font-size:14px"> <a href="/activity/add/" style="color: black; font-size:14px"> add resources </a> 
  <span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="text-align: center" class="menu">
      <li role="presentation" class="menuitem"><a role="menuitem" tabindex="1" href="{{ url('/contents/'.$content->id.'/lectures/create') }}" >  
  add lecture</a></li>
      <li role="presentation" class="menuitem"><a role="menuitem" tabindex="1" href="{{ url('/contents/'.$content->id.'/videos/create') }}"> add video</a></li>
      <li role="presentation" class="menuitem"><a role="menuitem" tabindex="1" href="{{ url('/contents/'.$content->id.'/assignments/create') }}">add assignment</a></li>
      <li role="presentation" class="menuitem"><a role="menuitem" tabindex="1" href="{{ url('/contents/'.$content->id.'/quizes/create') }}">add quiz </a></li>
  </ul>
</div>
</div>
</div>

@foreach($content->lectures as $lecture)
<div class="row"> 
<div class="col-sm-1 col-sm-offset-2"> <h4 style="display:inline-block"> <strong>  {{ \Illuminate\Support\Str::upper($lecture->lecture_name ) }} </strong> </h4> 
</div>

<div class="col-sm-1"> 
{!! Form::open(['action' => ['LectureController@edit', $lecture->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link edit" name="edit" id="edit" style="color:black; font-size:14px">  edit  </button> 
 {!! Form::close() !!} 
</div>
<div class="col-sm-1"> 
{!! Form::open(['action' => ['LectureController@destroy', $lecture->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link delete" style="color: black; font-size:14px"> delete </button>
 {!! Form::close() !!}   
</div>
</div> 

@endforeach
@endforeach
<br/>
<div class="row">
<div class="col-sm-1 col-sm-offset-1">
<a href="{!! route('contents.create') !!}" style="color: black" data-toggle="tooltip" title="Add Content">
<span class="glyphicon glyphicon-plus"> </span> </a>
<br/>
<br/>
<br/>
</div>
</div>

</div>
</div>


</div>
</div>
</div>


</div>
</div>


@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>


@endpush