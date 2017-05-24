@extends('layouts.index')
@section('title', 'Quizes| All')

@section ('current_page', 'Quizes')
@section ('content')
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">

<div class="row">
<div class="panel panel-primary" style="border: 0;">
<div class="panel-heading">
<div class="row">
<div class="col-sm-2">
Image
</div>
<div class="col-sm-10">
<h2> <b> Quizes </b> </h2>
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
</div>
</div>
</div>
@foreach($quizes as $quiz)
{{$quiz->quiz_name}}
@endforeach
</div>
</div>
@endsection