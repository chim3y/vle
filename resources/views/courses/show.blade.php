@extends('layouts.index')
@section('title', 'Courses')
@section('main_title', 'Courses')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-10 col-sm-offset-1">


<div class="panel panel-primary">
<div class="panel-heading">
<div class="row">
<div class="col-sm-2">
<img src="{{asset( "images/courses/". $course->image)}}" height="100" width="100"/>
</div>
<div class="col-sm-10">
<h2> <b> {{ \Illuminate\Support\Str::upper($course->course_name) }} </b> </h2>
</div>
</div>
</div>
<div class="panel-body">
<div class="row">
<div class="col-sm-2">
<img src="{{asset( "images/users/". $course->user->image)}}" class="img-circle" style="width:150px;height:150px;" />

</div>
<div class="col-sm-8 col-sm-offset-2" style="font-size:16px">
<br/>
<br/>
 <strong> Taught by: </strong> <u> {{ucfirst($course->user->name)}} </u>
</div>
</div>
<br/>
<br/>

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
	@foreach($semester->programmes as $programme)
  <a href="#" data-toggle="tooltip" data-placement="bottom" style="color:inherit" title="Programme Name:{{$programme->programme_name}}"> 
  {{$semester->semester_name}} 
  </a>.
 @endforeach
 @endforeach
	</td>

	<tr>
	
	<th class="col-md-4" style="border: 1px solid black; text-align: center"> <span class="glyphicon glyphicon-check"></span> &nbsp; Credits:  </th>

    <td style="border: 1px solid black; text-align: center"> {{$course->credits}} </td>
    </tr>
</table>
</div>
</div>
<div class="row">
<div class="col-sm-8 col-sm-offset-2">
<h3> Content </h3>
@foreach($course->contents as $content)
{{$content->name}}
@endforeach
<a href="/contents/create" style="color: inherit" data-toggle="tooltip" title="Add Content">
<span class="glyphicon glyphicon-plus"> </span> </a>
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