

 @if(Auth::user()->id==$question->user_id)
{!! Form::open(['action' => ['tutor\QuestionsController@destroy', 'id'=> $question->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-danger" style="color: white; font-size:14px"> <span class="glyphicon glyphicon-remove"> </span>Delete </button>
 {!! Form::close() !!} 

@endif

 @if(Auth::user()->id!=$question->user_id)
 {!! Form::open(['action' => ['tutor\QuestionsController@destroy', 'id'=> $question->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-danger  disabled" style="color: white; font-size:14px">  <span class="glyphicon glyphicon-remove"> </span>Delete </button>
 {!! Form::close() !!} 

@endif
