
@extends('layouts.index')
@section('title', 'Quiz | Create')
@section('main_title', 'Quiz')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('content')
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">

<div class="row">
<div class="panel panel-primary" style="border: 0;">
<div class="panel-heading">
<div class="row">
<div class="col-sm-10">
<h2> <b> Quizes </b> </h2>
</div>
</div>
</div>


<div class="panel-body">
{!! Form::open(['files'=>'true','route'=>['contents.quizes.store',$contentId]]) !!}



<div class="row">
<div class="form-group">

{!! Form::label('quiz_name','Quiz Name*',['class'=>'col-sm-2 control-label']) !!}
<div class="col-sm-5">
{!! Form::text('quiz_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<hr/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">
{{Form::submit('Add New Quiz', ['class'=>'btn btn-primary'])}}
</div>
</div>
</div>




</div>
</div>
</div>

</div>
</div>


{!! Form::close() !!}
@if($errors->any())
    <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li> {{ $error}} </li>
    @endforeach
    </ul>
@endif



@endsection