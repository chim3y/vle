@extends('layouts.index_admin')
@section('title', 'Department | Create')
@section('main_title')
<i class=" fa fa-building" aria-hidden="true"></i>  Department
@endsection
@section('sub_title', 'Create')
@section('current_page')
Department 
<li> Create</li>
@endsection
@section('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::open(['url'=>'/admin/departments']) !!}


 <div class="well" style="background-color: white">

<div class="row">
<div class="form-group"> 
{!! Form::label('department_code','Department Code*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('department_code',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('department_name','Department Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('department_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('user_id','HOD Name*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
  <select class="form-control" name="user_id">
  <option value="" selected> Please select HOD: </option>
    @foreach($tutors as $item)
      <option value="{{$item->user_id}}">

      {{$item->user->name}}</option>
    @endforeach
  </select>
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
<div class="col-lg-8 col-sm-offset-3">

 <a class="btn btn-success" href="javascript:history.back()" > &nbsp; Return Back </a> &nbsp; OR &nbsp;
    {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
  
  
</div>
</div>
</div>
</div>
<br/>
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