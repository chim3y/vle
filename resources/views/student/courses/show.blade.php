@extends('layouts.index_tutor')
@section('title', 'Courses | View')
@section('main_title')
<i class=" fa fa-book" aria-hidden="true"></i>  Courses
@endsection
@section('sub_title', 'View')
@section ('current_page', 'View')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
@endsection
@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'Student')

@section('link_dashboard')
<a href='/student/dasboard'> Dashboard </a>
@endsection
@section('content')
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
 <strong> Taught by: </strong> 

@if (is_null($course->user_id))
<b> {{ucfirst($course->admin->name)}} </b> 
@elseif(isset($course->user_id))
<b> {{ucfirst($course->user->name)}} </b> 

@endif
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
<div class="col-sm-2 col-sm-offset-1"> 
<h4 style="display:inline-block">  <strong> <kbd> {{ \Illuminate\Support\Str::upper($content->name) }} </kbd>  </strong>  </h4> 
</div>
</div>


@foreach($content->lectures as $lecture)
<div class="row"> 
<div class="col-sm-8 col-sm-offset-2"> 
<div class="well well-sm">
<div class="col-sm-4">
<h5 style="display:inline-block"> <a href="{{ route('student.contents.lectures.show', ['contentId'=> $content->id,'id'=>$lecture->id, str_slug($lecture->lecture_name)]) }}" style="color: black;" target="_self"> <strong>  {{ \Illuminate\Support\Str::upper($lecture->lecture_name ) }} </strong> </a></h5> 
</div>
</div> 
</div>
</div>
@endforeach
<br/>

@foreach($content->assignments as $assignment)
<div class="row"> 
<div class="col-sm-8 col-sm-offset-2"> 
<div class="well well-sm">
<div class="col-sm-4">
<h5 style="display:inline-block"> <a href="{{ route('student.contents.assignments.submission.show', ['contentID'=>$content->id, 'assignementID'=>$assignment->id]) }}" style="color: black;" target="_self"> <strong>  {{ \Illuminate\Support\Str::upper($assignment->assignment_title ) }} </strong> </a></h5>   
</div>
</div>
</div>
</div>
@endforeach
@endforeach
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

<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>
<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
@endpush