
@extends('layouts.index')
@section('title', 'Quiz | Create')
@section('main_title', 'Quiz')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section('stylesheets')
<style type="text/css"> 
.well:default
{
  background-color: #ffffff;
}
.well:hover
{
  background-color: #DCDCDC;
}
</style>
@endsection
@section ('content')

<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">

<div class="row">
<div class="panel panel-primary" style="border: 0;">
<div class="panel-heading">
<div class="row">
<div class="col-sm-10">
<h2> <b> {{$quiz->quiz_name}} </b> </h2>
</div>
</div>
</div>


 
<div class="panel-body">



<div class="row">
<div class="form-group">

<div class="col-sm-9">

<h1 style="text-align: center"> The Test contain {{count($quiz->questions)}} questions </h1>

</div>

</div>

</div>


<hr/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">

@if($attempt<=$quiz->max_attempt)

<a href="{{ route('student.quiz.attemptquiz', [$quiz->id, str_slug($quiz->quiz_name)]) }}" class="btn btn-default"> Start Quiz</a>

@endif
</div>
</div>
</div>

</div>
</div>
</div>

</div>
</div>



@endsection
