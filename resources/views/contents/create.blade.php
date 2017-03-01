@extends('layouts.index')
@section('title', 'Content| Create')
@section('main_title', 'Content')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::open(['url'=>'contents', 'files'=>'true']) !!}


 <div class="well" style="background-color: white">

<div class="row">
<div class="form-group"> 
{!! Form::label('name','Content Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('description','Description',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::textarea('description',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">
{{Form::submit('Add New Content', ['class'=>'btn btn-primary'])}}
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

</div>
</div>

@endsection