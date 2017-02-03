$(document).ready(function(){

	var firstClick = true;

	$("textarea").click(function(){

		if (firstClick) {
			$(this).val('');
			firstClick = false;
		}
	});
});