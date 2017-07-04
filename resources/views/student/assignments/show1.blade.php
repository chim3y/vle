
@extends('layouts.index')
@section('title', 'Assignment | View')
@section('main_title')
<i class="fa fa-tasks" aria-hidden="true"></i>
Assignment
@endsection
@section('sub_title', 'View')
@section ('current_page', 'View')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
{!! Html::script('/js/select2.min.js') !!}

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


<div class="col-sm-12" >
<br/>
<br/>
 {{ $assignment->description }} 



</div>
<hr style=" background-color: #f0f0f0;
  width: 100%;
  float: center;">
<div class="row">
<div class="form-group"> 

<h4> {!! Form::label('start_date','Start Date',['class'=>'col-sm-3 control-label']) !!} </h4>

<div class="col-sm-9">
{{ $assignment->start_date }} 
</div>
</div>
</div>


<div class="row"> 
<div class="form-group"> 
<h4> {!! Form::label('due_date','Due Date',['class'=>'col-sm-3 control-label']) !!} </h4>
<div class="col-sm-9">
{{ $assignment->due_date }} 
</div>
</div>
</div>

<div class="row"> 
<div class="form-group"> 
<h4> {!! Form::label('due_date','Left Days',['class'=>'col-sm-3 control-label']) !!} </h4>
<div class="col-sm-9">
{{ $leftdays}} days {{$lefthours}} hours  {{$leftminutes}} minutes {{$now->lt($due) == 1?  "before" :  "ago"}} 
</div>
</div>
</div>
<br/>

 @if(isset($assignment->document))                   
 

<a class="btn btn-xm btn-info col-sm-2" href="/download/{{$assignment->document}}" target="_blank"> Download Assignment</a>
                                  
   @else
                                                              
    No attachments found!
                                                                                                             
    @endif
<br/>
<hr style=" background-color: #f0f0f0;
  width: 100%;
  float: center;">
<br/>




{!! Form::model($submission,['files'=>'true','method'=>'PATCH', 'action'=>['student\AssignmentSubmissionController@update', "contentId"=>$assignment->content_id, "assignmentId"=>$assignment->id, "id"=>$submission->id ]]) !!}
<div class="row">
<div class="form-group"> 
<h4> {!! Form::label('description','Description',['class'=>'col-sm-3 control-label']) !!} </h4>
<div class="col-sm-12">
{!! Form::textarea('description',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>




<div class="row">
<div class="form-group">
  <h4>  {!! Form::label('document', 'Upload Document:',['class'=>'col-sm-3 control-label']) !!}</h4>
<div class="col-sm-12">
    {!! Form::file('document',null,['class'=>'form-control']) !!}


</div>
</div>
</div>
<br/>

<hr style=" background-color: #f0f0f0;
  width: 100%;
  float: center;">


<div class="row"> 
<div class="col-sm-12"> 

 @if(isset($submission->document))                   

                                      
<a class="btn btn-xm btn-info col-sm-2" href="/downloadsub/{{$submission->document}}" target="_blank"> Uploaded Assignment</a>
                                                                          
  @endif                                

</div>
</div>



@if($submission->grade>0)

<div class="row">
<div class="form-group"> 
<h4> {!! Form::label('grade','Grade', ['class'=>'col-sm-3 control-label']) !!}</h4>
 <div class="col-sm-6">
            {{$submission->grade}} out of {{$assignment->max_grade}}
 </div>
</div>
</div>
<br/>
@endif

@if($submission->feedback)
<div class="row">
<div class="form-group"> 
<h4> {!! Form::label('feedback','Feedback',['class'=>'col-sm-3 control-label']) !!} </h4>
<div class="col-sm-12">
{!! Form::textarea('feedback', null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>
@endif
<hr style=" background-color: #f0f0f0;
  width: 100%;
  float: center;">

 <br/> 
<br/>
<br/>


@if($submission->status==0)
@if ($now->lt($due) == 1)


<button type="submit" class="btn btn-info" name="save">Save</button>
<button  type="submit" class="btn btn-success" name="update" > Update</button> 
@endif
@endif
</div>
</div>
<br/>
<br/>


{!! Form::close() !!}


</div>
</div>
</div>
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
