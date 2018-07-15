$(document).ready(function() {
	$('#payment-form').submit(function() {
		var abort = false;
		$("div.error_message").remove();
		$(':input[required]').each(function() {
			if ($(this).val()==='') {
				$(this).after('<div class="error_message">This is a required field</div>');
				abort = true;
			}
		}); // go through each required value
		if (abort) { return false; } else { return true; }
	})//on submit
}); // ready

$('input[title]').blur(function() {
	$("div.error_message").remove();
	var myPattern = $(this).attr('pattern');
	var myTitle = $(this).attr('title');
	var isValid = $(this).val().search(myPattern) >= 0;

	if (!isValid) {
		$(this).focus();
		$(this).after('<div class="error_message">Error: ' + myTitle + '</div>');
	} // isValid test
}); // onblur
