
$(document).ready(function(){


//when the Add Field button is clicked
$("#add").click(function (e) {
 //Append a new row of code to the "#items" div
 $("#items").append(' <div>  <input type="text" name="answer[]" class="form-control"> <input type="checkbox" name="is_correct" value="0"> is Correct  <button  class="delete btn btn-danger">Delete</button></div>  '); });

$("body").on("click", ".delete", function (e) {
	$(this).parent("div").remove();



});

});