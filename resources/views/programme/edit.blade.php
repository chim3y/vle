@extends('layouts.index')
@section('title', 'Programme | Create')
@section('main_title', 'Programme')
@section('sub_title', 'Edit')
@section ('current_page', 'Edit')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
{!! Form::model($programme,['method'=>'PATCH', 'action'=>['ProgrammesController@update', $programme->id]]) !!}



 <div class="well" style="background-color: white">


<div class="row">
 <div class="form-group"> 
{!! Form::label('programme_code','Programme Code*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('programme_code',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>

<div class="row">
<div class="form-group"> 
{!! Form::label('programme_name','Programme Name*',['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
{!! Form::text('programme_name',null, ['class'=>'form-control']) !!}
</div>
</div>
</div>
<br/>


<div class="row">
<div class="form-group"> 
{!! Form::label('department_id','Department Name*', ['class'=>'col-sm-3 control-label']) !!}
<div class="col-sm-6">
  <select class="form-control" name="department_id">
    @foreach($department as $item)
      <option value="{{$item->id}}">{{$item->department_name}}</option>
    @endforeach
  </select>
</div>
</div>
</div>
<br/>


<div class="row">
<div class="col-lg-8 col-sm-offset-2">

   {!!Form::submit('Save and Continue',['class'=>'btn btn-primary'])!!}
    
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


<script type="text/javascript">
    $(document).ready(function () {
    $('.glyphicon-star').click(function () {
        $(this).parent("div").find(".glyphicon-star")
            .toggleClass("glyphicon-star");
    });
});
</script>

</div>
</div>

@endsection
