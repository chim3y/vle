

@extends('layouts.index_admin')
@section('title', 'Quizes | Attempt')
@section('main_title')
<i class="fa fa-question-circle" aria-hidden="true"></i>  Quizes
@endsection
@section('sub_title', 'Result')
@section ('current_page')
Quiz
<li> Result </li>
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

:checked + span {
     background-color: #f10;
     font-size: 15px;
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
<div class="row" style="height: 481px">
<div style="height: 90px;
  line-height: 90px;
  text-align: center;"> 
  @if( $userpercentage <40 )
   <h1> <i class="fa fa-hand-o-right" aria-hidden="true"></i> <a href='/quiz/'.$quiz->id.'/'.$quiz->name.'/attempquiz/'.$attempt->id.'/result' > PLEASE TRY AGAIN </a> </h1>
  @elseif( $userpercentage >=40  && $userpercentage< 50)
  <h1> <i class="fa fa-check-square-o " aria-hidden="true"></i> YOU HAVE PASSED </h1>
   @elseif( $userpercentage >=50  && $userpercentage< 60)
  <h1> <i class="fa fa-thumbs-up " aria-hidden="true"></i> YOU HAVE DONE GOOD </h1>
  @elseif( $userpercentage >=60  && $userpercentage< 70)
  <h1> <i class="fa fa-star" aria-hidden="true"></i> YOU HAVE DONE VERY GOOD </h1>
   @elseif( $userpercentage >70)
  <h1> <i class="fa fa-trophy" aria-hidden="true"></i> YOU ARE OUTSTANDING</h1>
  @endif

 <h3> <strong> TOTAL QUESTION: </strong> {!! count($quiz->questions) !!}
<br/>
<strong> STARTED AT: </strong> {{ $attempt->started_at }}
<br/>
<strong> ENDED AT: </strong> {{ $attempt->ended_at }}
<br/>
<strong> ATTEMPT: </strong> {{ $attempt->attempt}}
<br/>
<strong> ATTEMPTED BY: </strong> {{ ucfirst(trans(Auth::guard('admin')->user()->name))}}
<br/>
<strong>  Total Score: </strong> {{ array_sum($useranswer->pluck('marks')->toArray()) }} out of {!! 1* count($quiz->questions) !!}

</h3>
  </div>
</div>
   <div class="box box-default collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Review your answer</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
  
          <div class="row">
<div class="col-sm-12 col-sm-offset-1">
<br/>
<strong> TOTAL QUESTION: </strong> {!! count($quiz->questions) !!}
<br/>
<strong> STARTED AT: </strong> {{ $attempt->started_at }}
<br/>
<strong> ENDED AT: </strong> {{ $attempt->ended_at }}
<br/>
<strong> ATTEMPT: </strong> {{ $attempt->attempt}}
<br/>
<strong> ATTEMPTED BY: </strong> {{ ucfirst(trans(Auth::guard('admin')->user()->name))}}
<br/>
</div>
</div>

<hr/>

<div class="row">
<div class="form-group">
<div class="col-sm-9">



  @foreach($quiz->questions as $question) 
  <div class="panel panel-primary col-sm-12 col-sm-offset-2"> 
  
<div class="panel-heading">
<h3>Question: <strong>  {!!$question->question!!}  </strong> </h3>
</div>

 <br/>
 <div class="panel-body"> 
  @if($question->type== "single")
       @foreach($question->answer as $ans)
 <input type="radio"  value="{{$ans->id}}" {{ ($ans->id == $answer->where('question_id', $ans->question_id)->where('is_correct', 1)->first()->id) ? 'checked=checked' : '' }}> <span> {{$ans->answer}} </span> <br/>

       @endforeach
  
  <br/>
  <div class="panel-footer col-sm-12" style="background-color:#ffbb33"> 
  <strong> Your Answer: </strong>  
    @if(!is_null($useranswer->where('question_id', $ans->question_id)->first()))
    {{$answer->where('id', $useranswer->where('question_id', $ans->question_id)->first()->answer_id)->first()->answer}}
    <br/>
    <strong> Score: </strong> 
    {{ $useranswer->where('question_id', $ans->question_id)->first()->marks}} mark
   @elseif(is_null($useranswer->where('question_id', $ans->question_id)->first()))
   No answer choosen <br/>
   <strong> Score: </strong> 
   0 mark
   @endif
   <br/>

   
 </div>
    @elseif($question->type== "fill-in-blanks")
     <select class="form-control" name="answer">
      <option value="" >Choose one option </option>
     @foreach($question->answer as $ans)
      <option value="{{$ans->id}}">{{$ans->answer}} </option>
     @endforeach
     </select>
    <br/>
      <div class="panel-footer col-sm-12" style="background-color:#ffbb33"> 
    <strong> Your Answer: </strong> 
    @if(!is_null($useranswer->where('question_id', $ans->question_id)->first()))
    {{$answer->where('id', $useranswer->where('question_id', $ans->question_id)->first()->answer_id)->first()->answer}}
    <br/>
   @elseif(is_null($useranswer->where('question_id', $ans->question_id)->first()))
 No answer choosen 
    <br/>
   @endif
    <strong> Correct Answer: </strong> 
    {{$answer->where('question_id', $ans->question_id)->where('is_correct', 1)->first()->answer}}
   </div>


      @elseif($question->type== "multiple")
      @foreach($question->answer as $ans)

     <input type="checkbox"> {{$ans->answer}} <br/>
       @endforeach
       <br/>
 <div class="panel-footer col-sm-12" style="background-color:#ffbb33"> 
 <strong> Your Answer: </strong>

 @if(empty($useranswer->where('question_id', $ans->question_id)->first()->answer_id))
     No answer choosen
  @endif

  @if(!empty($useranswer->where('question_id', $ans->question_id)->pluck('answer_id')))
  @foreach($useranswer->where('question_id', $ans->question_id)->pluck('answer_id')  as $id )
  <br/>
  {{$answer->where('id',$id )->first()->answer }}  
    <strong> Score: </strong> 
     {{$useranswer->where('answer_id',$id )->first()->marks }}  mark
   @endforeach
   @endif 
 </div>
    
     @endif 

 </div>
 </div>

   @endforeach

 Total Score=  {{ array_sum($useranswer->pluck('marks')->toArray()) }} out of {!! 1* count($quiz->questions) !!}

 </div>
</div>
</div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->




</div>
<hr/>

<div class="row">
<div class="form-group">
<div class="col-lg-5 col-sm-offset-2">

</div>
</div>
</div>



</div>
</div>
</div>

</div>
</div>
<script>
          $("#box-widget").activateBox();
      </script>

@endsection

