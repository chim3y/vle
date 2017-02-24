@extends('layouts.index')
@section('title', 'Programme | Create')
@section('main_title', 'Programme')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::open(['url'=>'programmes']) !!}


 <div class="well" style="background-color: white">

<div class="row">
<div class="form-group"> 
{!! Form::label('programme_code','Programme Code*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('programme_code',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('programme_name','Programme Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('programme_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('department_id','Department Name*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
  <select class="form-control" name="department_id">
    @foreach($department as $item)
      <option value="{{$item->id}}">{{$item->department_name}}</option>
    @endforeach
  </select>
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
<div class="col-lg-8 col-sm-offset-2">
 <div class="dropup">
 <div class="btn-group">
 
    {!!Form::submit('Save and Continue',['class'=>'btn btn-primary'])!!}
    <a type="submit" class="btn btn-primary active dropdown-toggle" data-toggle="dropdown">
    <span class="glyphicon glyphicon glyphicon-menu-up"></span>
    </a>
    <ul class="dropdown-menu " role="menu">
    
    <li><a type="submit" name="add_another" value="Save course and add another course" href="/programmes/create">Save course and add another programme</a></li>
    <li><a type="submit" name="add_done" value="Save course and go to course index" href="/programmes/create">Save course and go to programme index </a></li>
   
    </ul>
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

</div>
</div>






@endsection