@extends('layouts.index_admin')
@section('title', 'Programme| Create')
@section('main_title')
<i class=" fa fa-graduation-cap" aria-hidden="true"></i>  Programme
@endsection
@section('sub_title', 'Create')
@section('current_page')
Programme
<li> Create </li>
@endsection
@section('content')
<br/>


<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::open(['url'=>'/admin/programmes']) !!}


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
 <a class="btn btn-success" href="javascript:history.back()" > &nbsp; Return Back </a> &nbsp; OR &nbsp;
 
    {!!Form::submit('Save and Continue',['class'=>'btn btn-primary'])!!}
  

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