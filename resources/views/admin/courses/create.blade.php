@extends('layouts.index_admin')
@section('title', 'Courses | Create')
@section('main_title', 'Courses')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
@endsection

@section ('content')

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::open(['url'=>'/admin/courses', 'files'=>'true']) !!}

 <div class="well" style="background-color: white">

 <div class="row">
 <div class="form-group">
 {!! Form::label('image','Upload Image:',['class'=>'col-sm-3 control-label']) !!}
 
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
<select class="select2-multi form-control" name="programme_id[]" multiple="multiple"> 
@foreach($programmes as $programme)
<option value="{{$programme->id}}"> 
{{$programme->programme_name}}
</option>
@endforeach
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
{!! Form::label('semester_id','Semester:', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
<select class="form-control" name="semester_id">
<option selected disabled>Please select one semester</option>
@foreach($semesters as $semester)
<option value="{{$semester->id}}"> 
{{$semester->semester_name}}
</option>
@endforeach
</select>
</div>
</div>
</div>
<br/>


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
@if($errors->any())
    <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li> {{ $error}} </li>
    @endforeach
    </ul>
@endif
{!! Form::close() !!}

</div>
</div>

@stop



@push('scripts')
{!! Html::script('/js/select2.min.js') !!}

<script type="text/javascript">
  $(".select2-multi").select2();
</script>
@endpush
