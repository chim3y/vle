@extends('layouts.index')
@section('title', 'Department | Create')
@section('main_title', 'Department')
@section('sub_title', 'Edit')
@section ('current_page', 'Edit')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::model($department,['method'=>'PATCH', 'action'=>['DepartmentsController@update', $department->id]]) !!}


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
{!! Form::label('tutor_id','HOD Name*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
  <select class="form-control" name="tutor_id">
    @foreach($tutors as $item)
      <option value="{{$item->id}}">{{$item->fname}} {{$item->lname}}</option>
    @endforeach
  </select>
</div>
</div>
</div>
<br/>


<div class="row">

<div class="col-lg-8 col-sm-offset-2">

   {!!Form::submit('Save and Continue',['class'=>'btn btn-primary'])!!}
    
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