@extends('layouts.index')
@section('title', 'Courses | Enroll ')
@section('main_title')
<i class=" fa fa-book" aria-hidden="true"></i>  Courses
@endsection
@section('sub_title', 'Enroll')
@section('current_page', 'Enroll')
@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'Student')

@section('link_dashboard')
<a href='/student/dasboard'> Dashboard </a>
@endsection
 
@section('content')
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
{!! Form::open(['action' => ['student\CoursesController@enroll'], 'method' => 'post']) !!}


<div class="well" style="background-color: white">


<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
  
  <input type="hidden" name="student_id" value={{$student_id}}>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="row">
<div class="col-sm-5 col-sm-offset-5">
<h4>
    {{ Form::label('enrollment_key', 'Enrollment Key') }}
</h4>
</div>
</div>

<div class="row">
<div class="col-sm-6 col-sm-offset-3">
<h3>
    <input type="password" class="form-control" name="enrollment_key">
</h3>
</div>
</div>




<br/>


<div class="row">
<div class="col-sm-5 col-sm-offset-5">
<input type="submit" class="btn btn-success"> 
</div>
</div>
</div>
<br>
@if($errors->any())
    <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li> {{ $error}} </li>
    @endforeach
    </ul>
@endif
{!! Form::close() !!}
 @if(Session::has('flash_message'))
        <div class="alert alert-danger">
            <h5>*{{ Session::get('flash_message') }}</h5>
        </div>
 @endif
</div>
</div>

@stop

