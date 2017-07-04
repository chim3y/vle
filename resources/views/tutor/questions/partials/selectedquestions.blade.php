 <input type="checkbox" value="{{$question->id}}" 
{!! in_array($question->id , Session::get('selectedquestion'))? 'checked':''  !!} name="selected_questions[]">