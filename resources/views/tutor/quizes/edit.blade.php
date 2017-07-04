
@extends('layouts.index_tutor')
@section('title', 'Quiz| Edit')
@section('main_title')
<i class="fa fa-question-circle" aria-hidden="true"></i>  Quizes
@endsection
@section('sub_title', 'Edit')
@section ('current_page')
Quizes
<li> Edit</li>
@endsection
@section('role', 'Tutor')

@section('link_dashboard')
<a href='/tutor/dasboard'> Dashboard </a>
@endsection
@section('stylesheets')
<style type="text/css"> 
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
<h2> <b> Quizes </b> </h2>
</div>
</div>
</div>


<div class="panel-body">

{!! Form::model($quiz,['method'=>'PATCH', 'action'=>['tutor\QuizesController@update', $contentId,$id]]) !!}


<div class="row">
<div class="form-group">

<div class="col-sm-9">
<div class="row">
<div class="col-sm-6">
{!! Form::text('quiz_name',null, ['class'=>'form-control', 'placeholder'=>'Quiz Name*']) !!}
<br/>
</div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-primary table-striped table-hover" id="questions_table">
        <thead style="background-color: #428bca;
    color: white;">
            <tr> 
                <th >Use</th>
                <th>Question</th>
                <th>Type</th>
                <th class="col-md-2">Operations </th>
            </tr>
        </thead>
</table>
<br/>

</div>
<br/>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('max_attempt','Maximum Attempt', ['class'=>'col-sm-3 control-label']) !!}
 <div class="col-sm-6">
            {{ Form::selectRange('max_attempt', 1, 10) }}
 </div>
</div>
</div>
<br/>

</div>

<div class="col-sm-3">
<br/>
<br/>
<div class="well well-sm" >
<h3> <b> <i class="fa fa-plus"> </i> Add questions</b> </h3>
<br/>
<br/>
<a href="{{ route('tutor.questions.create', ['type'=>'multiple']) }}" style="color: black;" target="_self">Multiple Question </a>
<br/>
<a href="{{ route('tutor.questions.create', ['type'=>'single']) }}" style="color: black;" target="_self">
Single Question
</a>
<br/>
<a href="{{ route('tutor.questions.create', ['type'=>'fill-in-blanks']) }}" style="color: black;" target="_self">
Fill in the blanks
</a>
<br/>
<br/>
</div>
</div>
</div>

</div>


<hr/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">
  <a class="btn btn-success" href="javascript:history.back()" > &nbsp; Return Back </a> &nbsp; OR &nbsp;
{{Form::submit('Edit Quiz', ['class'=>'btn btn-primary'])}}
</div>
</div>
</div>




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
<script>
$(function() {
    $('#questions_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
          ajax:"{{ route('tutor.contents.quizes.questionsData', array('id'=>$id, 'contentId'=>$contentId)) }}" ,
        columns: [
    
            { data: 'use', name:'id',  orderable: false },
            { data: 'question', name: 'question', orderable: false },
            { data: 'type', name: 'type', orderable: false },
            {data: 'action', name: 'action', orderable: false}
        ]
    });   
});
</script>
@endpush
