
@extends('layouts.index_tutor')
@section('title', 'Quiz| Questions | Fill in the blanks| Edit')
@section('main_title')
<i class="fa fa-question-circle" aria-hidden="true"></i>  Quizes
@endsection
@section('sub_title', 'Fill in the blanks')
@section ('current_page')
Quizes
<li> Questions </li>

<li> Fill in the blanks </li>
<li> Edit </li>
@endsection
@section('stylesheets')
@endsection
@section ('current_page')
<a href="javascript:history.back()" style="color: black;" target="_self"> Quiz </a> <li>  Edit question </li> <li> <a href="/tutor/questions/fill-in-blanks/create" style="color: black;" target="_self"> Fill in blanks </a> </li>
@endsection

@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'Tutor')

@section('link_dashboard')
<a href='/tutor/dasboard'> Dashboard </a>
@endsection
@section('stylesheets')
<style type="text/css"> 

<script>tinymce.init({ selector:'textarea' });</script>
.well:default
{
  background-color: #ffffff;
}
.well:hover
{
  background-color: #DCDCDC;
}
</style>


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
 <h2> <b>  {{ ucfirst(trans($type)) }} Question</b> </h2>
</div>
</div>
</div>



{!! Form::model($question,['method'=>'PATCH', 'action'=>['tutor\QuestionsController@update', '$id'=>$question->id]]) !!}


<div class="row">
<div class="col-sm-1"> </div>
<div class="col-sm-10">
{!! Form::textarea('question',null, ['class'=>'form-control']) !!}
</div>
<div class="col-sm-1"> </div>
</div>
<hr/>

<input type="hidden" name="user_id" value="{{Auth::guard('web')->user()->id}}">
<input type="hidden" name="back" value="{{ URL::previous() }}">
<div class="row">
<div class="col-sm-1"> </div>
<div class="col-sm-10">
<p> Note: Compose the question and place space for blanks. For example, The quick brown --- jumps over the lazy ---. 

</p>
</div>
<div class="col-sm-1"> </div>
</div>
<hr/>

<div class="row">
<div class="form-group">
<div class="col-sm-12">
<div class="col-sm-6 col-sm-offset-1">

@foreach($question->answer as $ans)

 <input type="text" name="answer[]" class="form-control col-sm-2" placeholder="{{$ans->answer}}">
</div>
<div class="col-sm-3">

 <input type="checkbox" name="is_correct0" value="0"> is Correct


</div>
</div>
</div>
</div>
<br/>
<br/>

@endforeach



<br/>
<br/>
<hr/>
<div class="row">
<div class="form-group">
<div class="col-sm-5 col-sm-offset-3">
<a class="btn btn-success" href="javascript:history.back()" > &nbsp; Return Back </a> &nbsp; OR &nbsp;
{{Form::submit('Save', ['class'=>'btn btn-primary ', 'name'=>'save'])}}
</div>
</div>
</div>
<br/>
<br/>



</div>
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



@endsection
@push('scripts')


<script src="/js/custom.js">
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
