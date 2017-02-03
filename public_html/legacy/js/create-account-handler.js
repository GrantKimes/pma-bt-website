var emailConfirmed = false; // Global since universal-form-handler shouldn't be edited but makes use of isSubmitReady.
var passwordConfirmed = false; // Global since universal-form-handler shouldn't be edited but makes use of isSubmitReady.

function are2InputsEqual(inputs, returnFalseOnEmpty){

	returnFalseOnEmpty = returnFalseOnEmpty || false; // Default for returnFalseOnEmpty is false, or can be set to true.
	var i = 0;
	var inputValArray = [];
	inputs.each(function(){

		inputValArray[i] = $(this).val();
		i++;
	})

	// If both inputs have a non-empty and both inputs are not equal
	if((inputValArray[0] != inputValArray[1]) && ((inputValArray[0] != "") && (inputValArray[1] != ""))){
		return false;
	}

	// If either input is empty and returnFalseOnEmpty is true
	else if(inputValArray[0] == "" || inputValArray[1] == "" && returnFalseOnEmpty){
		return false;
	}

	else{
		return true;
	}
}

function isSubmitReady(){

var enableSubmit = true;

	$("input.required").each(function(){

		if ($(this).val() == ""){
			enableSubmit = false;
		}
	});

	if (enableSubmit && are2InputsEqual($("input.email")) && are2InputsEqual($("input.password")) && emailConfirmed)
		$("button[type=submit]").removeAttr("disabled");
	else
		$("button[type=submit]").attr("disabled", "disabled");
}

function verifyEmailAvailability(emailVal){
	if(are2InputsEqual($("input.email"), true)){
	    var email = emailVal;
	    $("#email-availability").html("<img src='img/icons/ajax-loader.gif'>");

	    $.ajax({
	        type:"post",
	        url:"php/check-email-availability.php",
	        data:"email=" + email,
	        success:function(data){

	        	if(data=="available"){
	        		$("#email-availability").html(email + " is available!");
	        		emailConfirmed = true;
	        		isSubmitReady();
	        	}
	        	else{
	        		$("#email-availability").html(email + " is unavailable.");
	        		emailConfirmed = false;
	        	}
	        }
	    });
	}
}

$(document).ready(function(){

	verifyEmailAvailability($("input[name=email]").val());

	$("input[name=password]").change(function(){

		// Checks password for uppercase, lowercase, numbers, and length, and returns true if meets all requirements.
		function meetsRequirements(password){
			var uppercase = /[A-Z]/;
			var lowercase = /[a-z]/;
			var numbers = /[0-9]/;
			var length = password.length;

			if (uppercase.test(password) && lowercase.test(password) && numbers.test(password) && length > 8 && length < 24)
				return true;
			else
				return false;
		}

		if (meetsRequirements($(this).val())){
			$("p#invalid-pass").remove();
			passwordConfirmed = true;
		}

		else{
			$("p#invalid-pass").remove();
			$("#warnings").append("<p id='invalid-pass' class='small-text color-red'>Error: the entered password is invalid. A valid password must contain at least one uppercase and one lowercase letter, one number, and be between 8-24 total characters long.");
			passwordConfirmed = false;
		}

	});

	$("input[name=email], input[name=confirm-email]").change(function(){
		verifyEmailAvailability($(this).val());
    });

    $("input.email").change(function(){
    	$("#email-availability").empty();
    });

	$("input.email, input.password").change(function(){
		// Next line strips class required from input so that it properly passes into are2InputsEqual correctly. Make sure class required comes after all other classes in html.
		var inputClass = $(this).attr("class").replace(" required", "");
		if( !are2InputsEqual($("input." + inputClass)) ){
				$("p#" + inputClass).remove();
				$("#warnings").append("<p id='" + inputClass + "' class='small-text color-red'>Error: the entered " + inputClass + "s are not equal.");
		}
		else{
			$("p#" + inputClass).remove();
		}
	});

	$("#show-form").click(function(){
		$.ajax({ 
			url: "create-account.php",
        	data: "show-form=true",
        	type: 'post'
		});
	});

});