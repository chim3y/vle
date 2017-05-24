








<div class="row">

    @foreach($content->lectures as $lecture)
  
 <div class="col-sm-2 col-sm-offset-1"> <h4 style="display:inline-block"> <strong>  {{ \Illuminate\Support\Str::upper($lecture->lecture_name ) }} </strong> </h4> 
</div>

<div class="col-sm-1"> 
{!! Form::open(['action' => ['LectureController@edit', $lecture->id], 'method' => 'PATCH', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link edit" name="edit" id="edit" style="color:black; font-size:14px">  edit  </button> 
 {!! Form::close() !!} 
</div>
<div class="col-sm-1"> 
{!! Form::open(['action' => ['LectureController@destroy', $lecture->id], 'method' => 'delete', 'style'=>' display:inline-block']) !!}
    <button class="btn btn-link delete" style="color: black; font-size:14px"> delete </button>
 {!! Form::close() !!}   
</div>
</div> 
 @endforeach

@endforeach

<a href="{!! route('contents.create') !!}" style="color: black" data-toggle="tooltip" title="Add Content">
<span class="glyphicon glyphicon-plus"> </span> </a>
<br/>
<br/>
<br/>


</div>
</div>

