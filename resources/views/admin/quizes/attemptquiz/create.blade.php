
@extends('layouts.index_admin')
@section('title', 'Quizes | Attempt')
@section('main_title')
<i class="fa fa-question-circle" aria-hidden="true"></i>  Quizes
@endsection
@section('sub_title', 'Attempt')
@section ('current_page')
Quiz
<li> Attempt </li>
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
<h2> <b> {{$quiz->quiz_name}} </b> </h2>
</div>
</div>
</div>



{!! Form::open(['files'=>'true','method'=>'POST', 'action'=>['Admin\AttemptQuizController@store', "id"=>$quiz->id, "quiz_name"=>str_slug($quiz->quiz_name)]]) !!}

<div class="row">
<div class="form-group">
<br/>
<div class="col-sm-12">
<div class="col-sm-12 col-sm-offset-1" 
<h2> <strong>Started At: </strong>{{Carbon\Carbon::now('Europe/Sofia')}}  </h2>
</div>

<input type="hidden" name="started_at" value="{{Carbon\Carbon::now()}}" >

</div>

</div>

</div>


<hr/>

<div class="row">
<div class="form-group">
<div class="col-sm-9">

 
 @foreach($quiz->questions as $question) 

 
  <div class="well col-sm-12 col-sm-offset-2"> 
  
<br/> 

  {!!$question->question!!} 

 <br/>
      @if($question->type== "single")
       @foreach($question->answer as $ans)
       <input type="radio" name="answer{{$ans->question_id}}" value="{{$ans->id}}"> {{$ans->answer}} <br/>
       @endforeach
    
      @elseif($question->type== "fill-in-blanks")

     <select class="form-control" name="ans{{$question->question_id}}" >

     <option value=""> Please select one answer </option> 
    @foreach($question->answer as $ans)
      <option value="{{$ans->id}}">{{$question->answer ->answer}} </option>
     @endforeach
     </select>

  
      @elseif($question->type== "multiple")
      @foreach($question->answer as $ans)

       <input type="checkbox" name="manswer{{$ans->question_id}}[]" value="{{$ans->id}}">{{$ans->answer}} <br/>
       @endforeach


    @endif
  
     

 </div>

   @endforeach

 </div>
</div>
</div>
</div>
<hr/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">
{{Form::submit('Submit for Evaluation', ['class'=>'btn btn-primary'])}}
</div>
</div>
</div>


{!!Form::close()!!}

</div>
</div>
</div>

</div>
</div>



@endsection
