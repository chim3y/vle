@extends('layouts.index')
@section('title', 'User | Role Assignment')
@section('main_title', 'User')
@section('sub_title', 'Role Assignment')
@section ('current_page', 'Role Assignment')
@section ('content')
<br/>

<div class="row">
<div class="col-sm-8 col-sm-offset-2" >
<table class="table table-responsive table-condensed table-bordered">
<thead class="bg-primary" style="font-size: 15px">
<th class="text-center"> Name </th>
<th class="text-center"> Email </th>
<th class="text-center"> User </th>
<th class="text-center"> Tutor </th>
<th class="text-center"> Student </th>
</thead>	

<tbody>
@foreach($users as $user)

<tr>
{{ Form::open(['route'=>'admin.role.assign', 'method'=>'post']) }}
<td class="text-center"> {{$user->name }} </td>
<td class="text-center"> {{$user->email}} </td>
<td class="text-center"> <input type="checkbox" {{ $user->hasRole('Guest User')?'checked':'' }} name="user"> </td>
<td class="text-center"> <input type="checkbox" {{ $user->hasRole('Tutor')?'checked':'' }} name="tutor"> </td>
<td class="text-center"> <input type="checkbox" {{ $user->hasRole('Student')?'checked':'' }} name="student"> </td>
<td> <button type="submit" class="btn btn-primary btn-sm">Assign Roles </button> </td>
{{Form::close()}}
</tr>	

@endforeach
</tbody>


</table>

</div>
</div>

@endsection