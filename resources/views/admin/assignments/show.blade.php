
@extends('layouts.index_admin')
@section('title', 'Assignment | View')
@section('main_title', 'Assignment')
@section('sub_title', 'View')
@section ('current_page', 'View')
@section ('stylesheets')

<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=m9l1ubk5i6bnwxrcbf0opzturs6ut6vgvam2c9i48mxv4k8uy"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endsection
@section ('content')
<br/>

<div class="row">
<div class="col-sm-10 col-sm-offset-1">

<div class="row">
<div class="panel panel-primary" style="border: 0;">
<div class="panel-heading">
<div class="row">

<div class="col-sm-10">
<h4> <b>  {{ \Illuminate\Support\Str::upper($assignment->assignment_title) }} </b> </h4>
</div>

</div>
</div>

<div class="panel-body">
<div class="row">
<div class="col-sm-2">
<b> Start Date </b> 
</div>
<div class="col-sm-2">
{{ $assignment->start_date }} 
</div>
</div>


<div class="row"> 
<div class="col-sm-2">
<b> Due Date </b>
</div>

<div class="col-sm-2">
{{ $assignment->due_date }} 
</div>
</div>

<div class="col-sm-8 col-sm-offset-2">
<br/>
<br/>
{{ $assignment->description }} 


</div>
</div>
</div>


</div>
</div>
</div>
</div>



@endsection
