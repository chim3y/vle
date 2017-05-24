@extends('layouts.index_tutor')
@section('title', 'Courses | {{$course->course_name}}')
@section('main_title', 'Courses')
@section('sub_title', '')
@section ('current_page', 'Edit')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
@endsection
@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'Tutor')

@section('link_dashboard')
<a href='/tutor/dasboard'> Dashboard </a>
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

<div class="col-sm-8 col-sm-offset-2" style="font-size:16px">
<br/>
<br/>
 <strong> Taught by: </strong> <b> {{ucfirst($course->user ->name)}} </b> 
</div>
</div>
<br/>
<div class="row">
<div class="col-sm-8 col-sm-offset-2" style="font-size: 16px">
<table class="table table-bordered table-condensed" style="border: 1px solid black" >

  <tr>
  <th class="col-md-4" style="border: 1px solid black; text-align: center"> <span class="glyphicon glyphicon-time"> </span>&nbsp; Commitments:  </th>
  
  <td style="border: 1px solid black; text-align: center"> 5 hours </td>

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

<div id="app">
<div class="row">
<div class="container">

<div class="row">
<div class="col-sm-8 col-sm-offset-2">
<h3> Content </h3>
</div>
</div>
@foreach($course->contents as $content)
<div class="row">
<div class="col-sm-2"> 

<h4 style="display:inline-block"> <strong> <kbd> {{ \Illuminate\Support\Str::upper($content->name) }} </kbd> </strong> </h4> 
</div>
<div class="col-sm-4">

    <button class="btn btn-link edit" name="edit" id="edit" style="color:black; font-size:14px"> <a href="{{ url('/admin/contents/'.$content->id.'/edit')}}" target="_self" style="color:black"> edit </a>  </button> 

{!! Form::open(['action' => ['tutor\ContentController@destroy', $content->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link delete" style="color: black; font-size:14px"> delete </button>
 {!! Form::close() !!}   

<div class="dropdown" style="display:inline-block">
<button class="create btn btn-link dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" style="color: black; font-size:14px"> add resources <span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="text-align: center" class="menu">
      <li role="presentation" class="menuitem"><a target="_self" role="menuitem" tabindex="1"  href="{{ url('/contents/'.$content->id.'/lectures/create') }}" >  
  add lecture</a></li>
      <li role="presentation" class="menuitem"><a target="_self" role="menuitem" tabindex="1" href="{{ url('/contents/'.$content->id.'/videos/create') }}"> add video</a></li>
      <li role="presentation" class="menuitem"><a target="_self" role="menuitem" tabindex="1"  href="{{ url('/contents/'.$content->id.'/assignments/create') }}">add assignment</a></li>
      <li role="presentation" class="menuitem"><a target="_self" role="menuitem" tabindex="1"  href="{{ URL::route('contents.quizes.create', array('contentId'=> $content->id)) }}"> add quiz </a></li>
  </ul>
</div> 

</div>
</div>

@foreach($content->lectures as $lecture)
<div class="row"> 
<div class="col-sm-3 col-sm-offset-2"> <h5 style="display:inline-block"> <strong>  {{ \Illuminate\Support\Str::upper($lecture->lecture_name ) }} </strong> </h5> 
</div>

<div class="col-sm-2"> 
{!! Form::open(['action' => ['LectureController@edit', $lecture->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link edit" name="edit" id="edit" style="color:black; font-size:14px">  edit  </button> 
 {!! Form::close() !!} 

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
<a href="{!! route('tutor.contents.create') !!}" style="color: black" data-toggle="tooltip" title="Add Content">
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
</div>
<script src="/js/vue.min.js"> </script>
<script src="/js/main.js"> </script>

@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>
<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>


@endpush