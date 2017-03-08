@extends('layouts.index')
@section('title', 'Users | Create')
@section('main_title', 'Users')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
@endsection
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::model($course,['files'=>'true','method'=>'PATCH', 'action'=>['CoursesController@update', $course->id]]) !!}
 
 <div class="well" style="background-color: white">
 <div class="row">
 <div class="form-group">
 {!! Form::label('image','Edit Image',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::file('image') !!}
</div>
 </div>
 </div>
 <br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('course_name','Course Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('course_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('course_code','Course Code*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('course_code',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('programme_id','Programme Name:', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{{ Form::select('programme_id[]',$programmes,null, ['class'=>'form-control select2-multi', 'multiple'=>'multiple']) }}
</select>
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('credits','Credits*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('credits',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('semester_id','Semesters:', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">


{{ Form::select('semester_id',$semesters,null, ['class'=>'form-control', 'placeholder'=>'Please select one semester']) }}

</select>
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
{!! Form::label('room_no','Class Number', ['class'=>'col-sm-3 control-label']) !!}
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
    
    <li><a type="submit" name="add_another" value="Save course and add another course" href="/courses/create">Save course and add another course</a></li>
    <li><a type="submit" name="add_done" value="Save course and go to course index" href="/courses/create">Save course and go to course index </a></li>
   
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

@push('scripts')
{!! Html::script('/js/select2.min.js') !!}

<script type="text/javascript">
  $(".select2-multi").select2();
   $(".select2-multi").select2().val({!! json_encode($course->programmes()->getRelatedIds()) !!}).trigger('change');
  </script>
@endpush

@endsection