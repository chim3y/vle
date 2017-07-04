@extends('layouts.index_tutor')
@section('role', 'Tutor')
@section('title', 'Profile | View')
@section('main_title')
<i class="fa fa-user" aria-hidden="true"></i>  Profile
@endsection
@section('sub_title', 'View')
@section ('current_page')
Profile
<li> View </li>
@endsection
@section ('content')
<br/>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<br/>
<br/>
<div class="well col-sm-4" style="background-color: white; height:  500px">
   @if( !empty (Auth::user()->image))
<img src="{{ asset('/images/users/'.Auth::user()->image) }}"   style="height:90px; width:90px" class="img-circle" alt="User Image">
 @else
          <img src="{{ asset('/images/users/user_default.png') }}"  style="height:90px ; width:90px" class="img-circle" alt="User Image">
          @endif 
</div>

<div class="well col-sm-6" style="background-color: white; height:  500px">


<div class="page-header"> Basic Information </div>

<div class="row">
<div class="form-group"> 

{{$tutor->fname}} {{$tutor->mname}} {{$tutor->lname}} 

</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{{$tutor->dob}}
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{{$tutor->cid}}
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{{$tutor->sex}}
</div>
</div>
<br/>

<div class="page-header"> Account Information </div>

<div class="row">
<div class="form-group"> 
{{$tutor->isApproved}}
</div>
</div>
<br/>
<div class="row">
<div class="form-group"> 
{{$user->email}}
</div>
</div>
<br/>


<div class="page-header"> Course Details </div>

<div class="row">
<div class="form-group"> 
<li> {{$user->courses()->course_name}}  </li>
</div>
</div>
</div>
<br/>
</div>
</div>


@endsection