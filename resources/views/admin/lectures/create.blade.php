
@extends('layouts.index_admin')
@section('title', 'Lecture| Create')
@section('main_title', 'Lecture')
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section ('stylesheets')

<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=m9l1ubk5i6bnwxrcbf0opzturs6ut6vgvam2c9i48mxv4k8uy"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endsection
@section ('content')
<br/>

<div class="row">
<div class="col-sm-10 col-sm-offset-2" >

{!! Form::open(['route'=>['admin.contents.lectures.store', $contentId],'method' => 'POST', 'style'=>' display:inline-block', 'files'=>'true' ]) !!}

 <div class="well" style="background-color: white">

<div class="row">
<div class="form-group">



{!! Form::label('lecture_name','Lecture Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('lecture_name',null, ['class'=>'form-control']) !!}
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
    {!! Form::label('document', 'Upload Document:') !!}
<div class="col-sm-12">
    {!! Form::file('document',null,['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>
<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">
{{Form::submit('Add New Lecture', ['class'=>'btn btn-primary'])}}
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
