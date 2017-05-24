@extends('layouts.index')
@section('title', 'Programme | Create')
@section('main_title', 'Programme')
@section('sub_title', 'Edit')
@section ('current_page', 'Edit')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::model($programme,['method'=>'PATCH', 'route'=>['admin.programmes.update', $programme->id]]) !!}



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
 {{Form::select('department_id', $departments, null, ['class'=>'form-control'])}}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="col-lg-8 col-sm-offset-2">

   {!!Form::submit('Save and Continue',['class'=>'btn btn-primary'])!!}
    
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
