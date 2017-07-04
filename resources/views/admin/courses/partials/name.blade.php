 @if (is_null($course->user_id))
<b> {{ucfirst($course->admin->name)}} </b> 
@elseif(isset($course->user_id))
<b> {{ucfirst($course->user->name)}} </b> 
 @endif 