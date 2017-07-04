
@extends('layouts.index_tutor')
@section('title', 'Quiz| Attempt')
@section('main_title')
<i class="fa fa-question-circle" aria-hidden="true"></i>  Quizes
@endsection
@section('sub_title', 'Attempt')
@section ('current_page')
Quizes
<li> Attempt</li>
@endsection
@section('role', 'Tutor')

@section('link_dashboard')
<a href='/tutor/dasboard'> Dashboard </a>
@endsection
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

<h1 style="text-align: center"> The Test contain {{count($quiz->questions)}} questions</h1>
<h1 style="text-align: center"> Maximum Grade {{$quiz->max_grade}} grades</h1>

</div>

</div>

</div>


<hr/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">


  <a class="btn btn-success" href="javascript:history.back()" > &nbsp; Return Back </a> &nbsp; OR &nbsp;
<a href="{{ route('tutor.quiz.attemptquiz', [$quiz->id, str_slug($quiz->quiz_name)]) }}" class="btn btn-default"> Start Quiz</a>


</div>
</div>
</div>

</div>
</div>
</div>

</div>
</div>



@endsection
