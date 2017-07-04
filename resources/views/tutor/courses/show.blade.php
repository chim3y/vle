@extends('layouts.index_tutor')
@section('title')
Course | {{$course->course_name}}
@endsection
@section('main_title')
<i class=" fa fa-book" aria-hidden="true"></i>  Course
@endsection
@section('sub_title', 'View')
@section ('current_page', 'View')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
{!! Html::script('/js/select2.min.js') !!}
@endsection



@section('role', 'Tutor')


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

<table class="table table-bordered table-condensed" style="border: 1px solid black" >

  <tr>
  <th class="col-md-4" style="border: 1px solid black; text-align: center"> <span class="glyphicon glyphicon-time"> </span>&nbsp; Taught by: </th>
  
  <td style="border: 1px solid black; text-align: center">
  @if (is_null($course->user_id))
<b> {{ucfirst($course->admin->name)}} </b> 
@elseif(isset($course->user_id))
<b> {{ucfirst($course->user->name)}} </b> 

@endif </td>

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

<br/>

<div class="jumbotron col-sm-8 col-sm-offset-2">
{!!$course->description!!}

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
<div class="col-sm-8 col-sm-offset-1">
<div class="well well-sm">

          <h4 class="box-title" style="display:inline-block">  <strong> <kbd> {{ \Illuminate\Support\Str::upper($content->name) }} </kbd>  </strong> </h4>
        <div class="btn-group pull-right">
    <button class="btn btn-link" name="edit" id="edit" style="color:black; font-size:14px"> <a href="{{ url('/tutor/contents/'.$content->id.'/edit')}}" target="_self" style="color:black"> edit </a>  </button> 

 <div class="dropdown" style="display:inline-block">

<button class="create btn btn-link dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" style="color: black; font-size:14px"> add resources <span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="text-align: center" class="menu">
      <li role="presentation" class="menuitem"><a target="_self" role="menuitem" tabindex="1"  href="{{ URL::route('tutor.contents.lectures.create', array('contentId'=> $content->id)) }}" >  
  add lecture</a></li>
      <li role="presentation" class="menuitem"><a target="_self" role="menuitem" tabindex="1"  href="{{ URL::route('tutor.contents.assignments.create', array('contentId'=> $content->id)) }}">add assignment</a></li>
      <li role="presentation" class="menuitem"><a target="_self" role="menuitem" tabindex="1"  href="{{ URL::route('tutor.contents.quizes.create', array('contentId'=> $content->id)) }}"> add quiz </a></li>
  </ul>
</div> 

  {!! Form::open(['action' => ['tutor\ContentController@destroy', $content->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link " style="color: black; font-size:14px"> delete </button>
 {!! Form::close() !!}  

</div>
</div>
</div>

   
@foreach($content->lectures as $lecture)

<div class="row">
<div class="col-sm-6 col-sm-offset-2">
<div class="box box-solid  box-info collapsed-box ">
        <div class="box-header with-border">
          <h3 class="box-title" style="display:inline-block"> <a href="{{ route('tutor.lectures.show', [$lecture->id, str_slug($lecture->lecture_name)]) }}" style="color: black;" target="_self"> <strong> <i class="fa fa-file"> </i> &nbsp; {{ \Illuminate\Support\Str::upper($lecture->lecture_name ) }} </strong> </a> </h3> 

       
          <div class="box-tools pull-right">

           <button class="btn btn-box-tool  btn-link "  style="color:black; font-size:14px">  <a  href="{{ URL::route('tutor.contents.lectures.edit', array('contentId'=> $content->id, 'id'=> $lecture->id )) }}" target="_self" style="color:black"> edit </a>  </button> 

           {!! Form::open(['action' => ['tutor\LectureController@destroy', 'id'=> $lecture->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
            <button class="btn btn-box-tool btn-link" style="color: black; font-size:14px"> delete </button>
            {!! Form::close() !!}  
           
 
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        {!! $lecture->description !!}
</div>
</div>
<br/>
</div>
</div>



@endforeach
@foreach($content->assignments as $assignment)

<div class="row"> 
<div class="col-sm-6 col-sm-offset-2"> 
<div class="box box-solid  box-info collapsed-box ">
<div class="box-header with-border">
<h3 class="box-title" style="display:inline-block">
 <a href="{{ route('tutor.assignments.show', [$assignment->content_id, $assignment->id, str_slug($assignment->assignment_title)]) }}" style="color: black;" target="_self"> <strong> <i class="fa fa-tasks"> </i> &nbsp; {{ \Illuminate\Support\Str::upper($assignment->assignment_title ) }} </strong> </a></h3> 
   <div class="box-tools pull-right">
 <button class="btn btn-box-tool  btn-link "  style="color:black; font-size:14px">  
 <a  href="{{ URL::route('tutor.contents.assignments.edit', array('contentId'=> $content->id, 'id'=> $assignment->id )) }}" target="_self" style="color:black"> edit </a>  </button> 
  
 

{!! Form::open(['action' => ['tutor\AssignmentController@destroy', 'id'=> $assignment->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link  btn -box-tool" style="color: black; font-size:14px"> delete </button>
 {!! Form::close() !!}   
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        {!! $assignment->description !!}
</div>
</div>
<br/>
</div>
</div>

@endforeach


@foreach($content->quizes as $quiz)


<div class="row"> 
<div class="col-sm-6 col-sm-offset-2"> 
<div class="box box-solid  box-info collapsed-box ">
<div class="box-header with-border">
<h3 class="box-title" style="display:inline-block">
<a href="{{ route('tutor.quiz.show', [$quiz->id, str_slug($quiz->quiz_name)]) }}" style="color: black;" target="_self"> <strong> <i class="fa fa-pencil-square"> </i> &nbsp; {{ \Illuminate\Support\Str::upper($quiz->quiz_name ) }}  </strong> </a></h3 > 
   <div class="box-tools pull-right">
 <button class="btn btn-box-tool  btn-link "  style="color:black; font-size:14px">  

    <button class="btn btn-link pull-right"  style="color:black; font-size:14px">  <a  href="{{ URL::route('tutor.contents.quizes.edit', array('contentId'=> $content->id, 'id'=> $quiz->id )) }}" target="_self" style="color:black"> edit </a>  </button> 
 

{!! Form::open(['action' => ['tutor\QuizesController@destroy', 'id'=> $quiz->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link btn-box-tool" style="color: black; font-size:14px"> delete </button>
 {!! Form::close() !!}   
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        {!! $quiz->description !!}
</div>
</div>
<br/>
</div>
</div>
@endforeach
@endforeach
<br/>
<br/>

<br/>
<br/>
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