@extends('layouts.index_admin')


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
<div class="well col-sm-8" style="background-color: white; height:  500px">
</div>
</div>
</div>

@endsection