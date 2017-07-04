
@extends('layouts.index_admin')
@section('title', 'Assignment | View')
@section('main_title')
<i class=" fa fa-task" aria-hidden="true"></i>  Assignment
@endsection
@section('sub_title', 'View')
@section ('current_page', 'View')
@section('stylesheets')
{!!Html::style('/css/select2.min.css')!!}
{!! Html::script('/js/select2.min.js') !!}

  <script>tinymce.init({ selector:'textarea' });</script>
@endsection
@section ('content')
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

<h4> {!! Form::label('sstart_date','Start Date',['class'=>'col-sm-3 control-label']) !!} </h4>

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
<h4> {!! Form::label('due_date','Due Date',['class'=>'col-sm-3 control-label']) !!} </h4>
<div class="col-sm-9">
{{ $leftdays}} days {{$lefthours}} hours  {{$leftminutes}} minutes {{$now->lt($due) == 1?  "before" :  "ago"}} 
</div>
</div>
</div>
<br/>
<hr style=" background-color: #f0f0f0;
  width: 100%;
  float: center;">


<div class="row"> 
<div class="col-sm-12"> 
@if(isset($assignment->document))                   
  
<a class="btn btn-xm btn-info col-sm-2" href="\download\{{$assignment->document}}" target="_blank"> Download File</a>
                                      
   @else
                                                              
    No attachments found!
                                                                                                             
    @endif

</div>
</div>
<hr style=" background-color: #f0f0f0;
  width: 100%;
  float: center;">
<br/>
<div class="row"> 
<div class="table-responsive">
    <table class="table table-bordered table-primary table-striped table-hover" id="courses_table">
        <thead style="background-color: #428bca;
    color: white;">
            <tr> 
                <th>Student</th>
                <th>Description </th>
                <th>Document </th>
                <th>Submitted on </th>
                <th class="col-md-2">Operations </th>
            </tr>
        </thead>
</table>
</div>
</div>



</div>
</div>


</div>
</div>
</div>
</div>



@endsection
@push('scripts')

<script>
$(function() {
    $('#courses_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
              ajax:"{{ route('admin.submissionData', array('id'=>$assignment->id, 'contentId'=>$assignment->content_id)) }}" ,
        columns: [
            { data: 'name', name: 'name', orderable: false },
            { data: 'description', name: 'description', orderable: false },
            { data: 'document', name: 'document', orderable: false },
            {data: 'created_at', name: 'created_at', orderable: false },
            {data: 'action', name: 'action', orderable: false}
        ]
    });   
});
</script>

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
