@extends('layouts.index')
@section('title', 'Courses | Create')
@section('main_title', 'Courses')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::open(['url'=>'courses']) !!}
 <div class="well" style="background-color: white">
<div class="row">
<div class="form-group"> 
{!! Form::label('course_name','Course Name',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('course_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('course_code','Course Code',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('course_code',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('programme_code','Programme Code', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('programme_code',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('credits','Credits', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('credits',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('start_date','Start Date', ['class'=>'col-sm-3 control-label']) !!}
 <div class="col-sm-6">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker">
                </div>
 </div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('end_date','End Date', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker1">
                </div>
</div>
</div>
</div>

<br/>
<div class="row">
<div class="form-group"> 
{!! Form::label('description','Desription', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('class_no','Class Number', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('class_no', null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('building_no','Building Number', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('building_no',null, ['class'=>'form-control']) !!}
</div>
</div>
</dv>
<br/>
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
    <li><a href="/courses/create">Save course and add another course</a></li>
    <li><a href="/courses">Save course and go to course index</a></li>
    </ul>
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

</div>
</div>




<script type="text/javascript">
	$(document).ready(function () {
    $('.glyphicon-star').click(function () {
        $(this).parent("div").find(".glyphicon-star")
            .toggleClass("glyphicon-star");
    });
});
</script>

@endsection