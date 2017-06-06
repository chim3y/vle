
@extends('layouts.index_admin')
@section('title', 'Assignment | Create')
@section('main_title', 'Assignment')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('stylesheets')

<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=m9l1ubk5i6bnwxrcbf0opzturs6ut6vgvam2c9i48mxv4k8uy"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endsection
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >

{!! Form::open(['route'=>['admin.contents.assignments.store', $contentId],'method' => 'POST', 'style'=>' display:inline-block', 'files'=>'true' ]) !!}

 <div class="well" style="background-color: white">

<div class="row">
<div class="form-group">



{!! Form::label('assignment_title','Assignment Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('assignment_title',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('description','Description',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-12">
{!! Form::textarea('description',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>




<div class="row">
<div class="form-group">
    {!! Form::label('document', 'Upload Document:',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-12">
    {!! Form::file('document',null,['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('start_date','Start Date', ['class'=>'col-sm-3 control-label']) !!}
 <div class="col-sm-6">
             {!! Form::input('date','start_date', date('Y-m-d'), ['class'=>'form-control'])!!}
 </div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('due_date','Due Date', ['class'=>'col-sm-3 control-label']) !!}
 <div class="col-sm-6">
            {!! Form::input('date','due_date', date('Y-m-d'), ['class'=>'form-control'])!!}
 </div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('max_grade','Maximum Grade', ['class'=>'col-sm-3 control-label']) !!}
 <div class="col-sm-6">
            {{ Form::selectRange('max_grade', 1, 100) }}
 </div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">
{{Form::submit('Add New Assignment', ['class'=>'btn btn-primary'])}}
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
