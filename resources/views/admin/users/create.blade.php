
@extends('layouts.index_admin')
@section('title', 'Users | Create')
@section('main_title')
<i class=" fa fa-user" aria-hidden="true"></i>  User
@endsection
@section('sub_title', 'Users')
@section ('current_page', 'Create')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
{!! Html::script('/js/select2.min.js') !!}

  <script>tinymce.init({ selector:'textarea' });</script>
@endsection

@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::open(['url'=>'/admin/users/store','files'=>'true']) !!}
 <div class="well" style="background-color: white">

<div class="page-header"> Basic Information </div>
 <div class="row">
 <div class="form-group">
 {!! Form::label('image','Upload Image',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
<div class="well">
{!! Form::file('image') !!}

</div>
 </div>
 </div>
 <br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('user_type','User Type*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
<select name="user_type" class="form-control">
<option value=""> </option>
<option value="student"> Student </option>
<option value="tutor"> Tutor </option>
</select>
</div>
</div>
</div>
<br/>

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
{!! Form::label('email','Email',['class'=>'col-sm-3 control-label']) !!}
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
<input type="password" class="form-control"> 
</div>
</div>
</div>
<br/>
 






<div class="row">
<div class="form-group"> 
 <div class="col-md-6 col-md-offset-4">
 <div class="dropup">
 <div class="btn-group">
 
     {!!Form::submit('Save and Continue',['class'=>'btn btn-primary'])!!}
    <a type="submit" class="btn btn-primary active dropdown-toggle" data-toggle="dropdown">
    <span class="glyphicon glyphicon glyphicon-menu-up"></span>
    </a>
    <ul class="dropdown-menu " role="menu">
    <li><a href="/admin/users/create">Save User and add another user</a></li>
    <li><a href="/admin/users">Save User and go to users index</a></li>
    </ul>
</div> 
</div>
</div>
</div>
</div>
</div>
</div>
<br/>
{!! Form::close() !!}


</div>
<div class="row">
 <div class="col-md-6 col-md-offset-4"> 
@if($errors->any())
    <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li> {{ $error}} </li>
    @endforeach
    </ul>

@endif
</div>
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