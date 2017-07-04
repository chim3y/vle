
@extends('layouts.index_tutor')
@section('title', 'Assignment| Create ')
@section('main_title')
<i class=" fa fa-task" aria-hidden="true"></i>  Assignment
@endsection
@section('sub_title', 'Create')
@section('current_page', 'Create')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
{!! Html::script('/js/select2.min.js') !!}

  <script>tinymce.init({ selector:'textarea' });</script>
@endsection
@section('role', 'Tutor')

@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >

{!! Form::open(['route'=>['tutor.contents.assignments.store', $contentId],'method' => 'POST', 'style'=>' display:inline-block', 'files'=>'true' ]) !!}

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