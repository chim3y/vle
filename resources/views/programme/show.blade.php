@extends('layouts.index')
@section('title', 'Courses | Create')
@section('main_title', 'Courses')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
 
@foreach($programme as $prgm)
<h3> {{$prgm->programme_name}} </h3>

<br/>
<br/>

<ul>
@foreach($prgm->course_programme as $prgmm)
@foreach($prgmm->courses as $prg)
 <li>{{$prg->semester_taken}} </li>
     <li> {{$prg->course_name}} </li>
   
@endforeach
@endforeach
@endforeach
</ul>


</div>
</div>
@endsection