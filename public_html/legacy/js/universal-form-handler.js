/*
// Should be copy-pasted into specific handlers because specific conditions may exist.
function isSubmitReady(){

var enableSubmit = true;

	if ($("input[type=radio]").val()){ // If this input type exists
		if (!$("input[type=radio]").is(":checked")){ // If radio button is not filled out
			enableSubmit = false;
		}
	}

	$("input.required").each(function(){

		if ($(this).val() == ""){
			enableSubmit = false;
		}
	});

	if (enableSubmit)
		$("button[type=submit]").removeAttr("disabled");
	else
		$("button[type=submit]").attr("disabled", "disabled");
}
*/

function isSubmitReady(){

	var count = $("input.required, textarea.required").length - 1;

	// Loops through each required input. If one does not have a value, function returns. If all have values, submit button is enabled.
	$("input.required, textarea.required").each(function(){
		
		if ($(this).val() == ""){
			$("button[type=submit]").attr("disabled", "disabled");
			return;
		}

		else if (count == 0){
			$("button[type=submit]").removeAttr("disabled");
		}

		count--;
	});
}

$(document).ready(function(){

	$("label.help").hide();
	isSubmitReady();

	$("input").each(function(){
		if($(this).val() != "" && $(this).attr("type") != "radio")
			$("label[for=" + $(this).attr("name") + "]").animate({color: "#606060"}, 200);

		else if($(this).attr("type") == "radio" && $(this).attr("checked") == "checked"){
			$("label[for=" + $(this).attr("name") + "]").animate({color: "#606060"}, 200);
		}
	});

	$("input, select").focus(function(){
		$("label[for=" + $(this).attr("name") + "]").fadeIn(100);
	});

	// Updates required input and textareas if they have been filled, changing labels from red to gray.
	$("input, textarea, select").blur(function(){

		$("label.help[for=" + $(this).attr("name") + "]").fadeOut(200);

		// If this input has a non-empty value and is required
		if ($(this).val() != "" && $("label[for=" + $(this).attr("name") + "]").hasClass("required"))
			$("label[for=" + $(this).attr("name") + "]").animate({color: "#606060"}, 200);

		// If this input's value is empty (by default from above) and has class required
		else if ($("label[for=" + $(this).attr("name") + "]").hasClass("required"))
			$("label[for=" + $(this).attr("name") + "]").animate({color: "#c50b33"}, 200);

		isSubmitReady();
	});

	$("input[type=radio]").click(function(){
		$("label[for=" + $(this).attr("name") + "]").animate({color: "#606060"}, 200);
		isSubmitReady();
	});

	$("input[type=file]").change(function(){
		$("label[for='img']").animate({color: "#606060"}, 200);
		isSubmitReady();
	});

});