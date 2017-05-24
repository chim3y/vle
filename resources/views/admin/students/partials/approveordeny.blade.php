
<form style="display: inline-block" action="{{ route('admin.students.update', $student->id)}}" method="PATCH"> 
 <input type = "hidden" name = "isApproved" value = "1">
 <button type="submit" class="btn btn-primary" style="color:white">    <strong>Approve</strong>  </button>
 </input>
</form> 
                 
<form style="display: inline-block" action="{{ route('admin.students.update', $student->id)}}" method="PATCH"> 
<input type = "hidden" name = "isApproved" value="2">
<button type="submit" class="btn btn-primary" style="color:white">  <strong>Deny</strong>  </button>
</input>
</form>