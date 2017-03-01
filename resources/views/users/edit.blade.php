@extends('layouts.index')
@section('title', 'Users | Create')
@section('main_title', 'Users')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::model($user,['files'=>'true','method'=>'PATCH', 'action'=>['UsersController@update', $user->id]]) !!}
 <div class="well" style="background-color: white">

 <div class="page-header"> Basic Information </div>
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
{!! Form::label('first_name','First Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('first_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('middle_name','Middle Name',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('middle_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('last_name','Last Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('last_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('dob','Date of Birth*', ['class'=>'col-sm-3 control-label']) !!}
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
{!! Form::label('cid','CID*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('cid',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('phone','Mobile Number*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('phone',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="page-header"> Account Information </div>

<div class="row">
<div class="form-group"> 
{!! Form::label('name','User Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>
<div class="row">
<div class="form-group"> 
{!! Form::label('email','Email*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::email('email',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('password','Password*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::password('password',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="page-header"> School Details </div>

<div class="row">
<div class="form-group"> 
{!! Form::label('school_name','School Name*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('school_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('department_name','Department Name*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('department_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('programme_name','Programme Name*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('programme_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('semester_id','Semester Number*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::select('semester_id',$semesters, null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="page-header"> Address Details </div>


<div class="row">
<div class="form-group"> 
{!! Form::label('street_name','Street Name', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('street_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>



<div class="row">
<div class="form-group"> 
{!! Form::label('room_no','Room Number', ['class'=>'col-sm-3 control-label']) !!}
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
    <li><a href="/users/create">Save course and add another usere</a></li>
    <li><a href="/users">Save course and go to users index</a></li>
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