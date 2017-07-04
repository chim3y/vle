
{!! Form::open(['action' => ['Admin\AssignmentController@view', 'contentId'=>$assignment->first()->content_id,'assignemntId'=>$assignment->first()->id,'id'=> $submission->id], 'method' => 'GET', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-danger" style="color: black; font-size:14px"> View </button>
 {!! Form::close() !!} 
