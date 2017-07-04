@extends('layouts.index_admin')
@section('title', 'Courses | Create')
@section('main_title')
<i class=" fa fa-book" aria-hidden="true"></i>  Courses
@endsection
@section('sub_title', 'Create')
@section ('current_page', 'Create')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
{!! Html::script('/js/select2.min.js') !!}

  <script>tinymce.init({ selector:'textarea' });</script>
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
<div class="col-sm-8 ">
{!! Form::text('course_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('course_code','Course Code*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-8">
{!! Form::text('course_code',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('programme_id','Programme*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
<select class="form-control" name="programme_id">
<option selected disabled>Please select one Programme</option>
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
<div class="col-sm-8 ">
{!! Form::text('credits',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>





<div class="row">
<div class="form-group"> 
{!! Form::label('semester_id','Semester*', ['class'=>'col-sm-3 control-label']) !!}
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
<div class="col-sm-8 ">
{!! Form::textarea('description',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('enrollment_key','Enrollment Key', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-8 ">
<input type="password" class="form-control" name="enrollment_key">
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('room_no','Class Number', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-8 ">
{!! Form::text('room_no', null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('building_name','Building Number', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-8 ">
{!! Form::text('building_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</dv>
<br/>
<br/>

<div class="row">
<div class="form-group"> 
<div class="col-lg-8 col-sm-offset-2">

  <a class="btn btn-success" href="javascript:history.back()" > &nbsp; Return Back </a> &nbsp; OR &nbsp;
    {!!Form::submit('Save and Continue',['class'=>'btn btn-primary'])!!}
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
<script type="text/javascript" src="{{ URL::to('js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
var editor_config = {
path_absolute : "{{ URL::to('') }}/",
selector : "textarea",
plugins: [
"advlist autolink lists link  charmap print preview hr anchor pagebreak",
"searchreplace wordcount visualblocks visualchars code fullscreen",
"insertdatetime nonbreaking save table contextmenu directionality",
"emoticons template paste textcolor colorpicker textpattern"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
relative_urls: false,
file_browser_callback : function(field_name, url, type, win) {
var x = window.innerWidth || document.documentElement.clientWidth || document.getElementByTagName('body')[0].clientWidth;
var y = window.innerHeight|| document.documentElement.clientHeight|| document.grtElementByTagName('body')[0].clientHeight;
var cmsURL = editor_config.path_absolute+'laravel-filemanaget?field_name'+field_name;
if (type = 'image') {
cmsURL = cmsURL+'&type=Images';
} else {
cmsUrl = cmsURL+'&type=Files';
}

tinyMCE.activeEditor.windowManager.open({
file : cmsURL,
title : 'Filemanager',
width : x * 0.8,
height : y * 0.8,
resizeble : 'yes',
close_previous : 'no'
});
}
};

tinymce.init(editor_config);
</script>
@endpush
