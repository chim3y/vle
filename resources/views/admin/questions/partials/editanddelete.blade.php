         


{!! Form::open(['action' => ['Admin\QuestionsController@destroy', 'id'=> $question->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-danger" style="color: black; font-size:14px"> Delete </button>
 {!! Form::close() !!} 