@extends('layouts.index_admin')
@section('title', 'Home | Semesters')
@section('main_title')
<i class=" fa fa-calendar-o" aria-hidden="true"></i>  Semesters
@endsection
@section('sub_title', 'Create')
@section ('current_page')
Semesters 
<li> Create </li>
@endsection
@section('stylesheets')

@endsection
@section('content')
<div class="row">
<div class="col-md-4 col-sm-offset-1">
<br/>
<br/>

<br/>
<br/>
 <div class="table-responsive">
 <table class="table table-bordered table-primary table-striped table-hover">
	    <thead style="background-color:   #428bca;
    color: white;">
	<tr>
	<th style="text-align:center;"> Id </th>
	<th style="text-align:center;"> Semester Name </th>
	<th style="text-align:center;"> Action </th>
	</tr>
	</thead>
	<tbody>
	  
		@foreach($semesters as $sem)
		<tr>
		<th style="text-align:center;"> {{$sem->id}} </th>
        <td style="text-align:center;"> {{$sem->semester_name}} </td>
        <td style="text-align:center;" id="delete"> {{ Form::open(['method' => 'DELETE', 'route' => ['admin.semesters.delete', $sem->id] , 'style'=>'display: inline-block']) }}
 {!! csrf_field() !!}
<button class="btn btn-danger" type="submit" id="remove"><span class="glyphicon glyphicon-minus" > </span> &nbsp; Remove</button>
</div>
{{Form::close()}} </td>
        </tr>
		@endforeach
		
	</tbody>
</table>
</div>
</div>

<div class="col-sm-3">
<div class="well">
<h2 id="one"> Create Semester</h2>
{!! Form::open(['route'=>'semesters.store', 'method'=>'POST']) !!}

 {!! Form::label('semester_name','Semester Name',['class'=>'control-label']) !!}
 {!! Form::text('semester_name',null, ['class'=>'form-control']) !!}
 <br/>
<button class="btn btn-primary btn-block" type="submit" id="create">  Create Mew Semester</button>

 <br/>
{!! Form::close()!!}
@if($errors->any())
    <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li> {{ $error}} </li>
    @endforeach
    </ul>
@endif
</div>
</div>

</div>

@stop
@push('scripts')
<Script>
// Instance the tour
var tour = new Tour({
  debug: true,
  storage: false,
  steps: [
  {
    element: "#one",
    title: "Create new semester",
    content: "Add unique Semester Name <br/> e.g Roman letter 'I', 'II', etc ",
    placement: "right",
    duration:5000
  },
  {
    element: "#delete",
    title: "Delete Semester",
    content: "Click here to delete the semester",
    placement: "right",
    onShow: function() {
      return $("#aone").addClass("open");
    },      
    onHide: function() {
      $("#one").removeClass("open"); 
    } 
  }    
]});

if (tour.ended()) {
  tour.restart();
} else {
  tour.init();
  tour.start();
}

</Script>
<script>
    $('#remove').click(function(){
this.form.submit();
this.disabled=true;
this.innerHTML='<i class="fa fa-spinner fa-spin"></i> Removing...';
});

</script>
<script >
    $('#create').click(function(){
this.form.submit();
this.disabled=true;
this.innerHTML='<i class="fa fa-spinner fa-spin"></i> Creating...';
});

</script>
<Script>
$('h2').tooltip().eq(0).tooltip('show').tooltip('disable').one('mouseout', function() {
  $(this).tooltip('enable');
});

setTimeout(function() {
 $('h2').tooltip().eq(0).tooltip('hide').tooltip('enable');
}, 5000);
</Script>
@endpush