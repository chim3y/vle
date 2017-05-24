
@extends('layouts.index_admin')
@section('title', 'Lecture| Edit')
@section('main_title', 'Lecture')
@section('sub_title', 'Edit')
@section ('current_page', 'Edit')
@section ('content')
@section ('stylesheets')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endsection
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >

{!! Form::model($lecture, ['files'=>'true','method'=> 'PATCH', 'route'=>['admin.contents.lectures.update', $contentId, $id]]) !!}


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
<div class="col-sm-6">
{!! Form::textarea('description',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">
{{Form::submit('Edit Lecture', ['class'=>'btn btn-primary'])}}
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
@push('scripts')

@endpush