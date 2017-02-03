function convertSecurityQuestion(questionNumber){

	questionNumber = Number(questionNumber);

	switch(questionNumber){

		case 1:
			return "In what city or town was your first job?";
		case 2:
			return "What is the name of a college you applied to but didn't attend?";
		case 3:
			return "What is your oldest sibling's middle name?";
		case 4:
			return "What was your childhood nickname?";
		case 5:
			return "What is your maternal grandmother's maiden name?";
		case 6:
			return "What school did you attend for sixth grade?";
		case 7:
			return "What is the last name of your favorite high school teacher?";
		case 8:
			return "What is the middle name of your youngest child?";
		default:
			return "There was an error retrieving your security question. Please contact us for assistance. We apologize for the inconvenience.";
	}
}

function showSecurityQuestion(resultData){

	$("#answer-security").slideDown(200);
	$("#security-question").empty().append(convertSecurityQuestion(resultData.securityQuestion));

	$("#always-show input").change(function(){
		$("#answer-security").slideUp(200);
	});

	$("button[name=verify-security-answer]").click(function(){

		$("#security").html("<img src='img/icons/ajax-loader.gif'>");

		if(resultData.securityAnswer == $("input[name=security-answer]").val())
			var answerIsCorrect = true;
		else
			var answerIsCorrect = false;

		$.ajax({
			type: "post",
			url: "php/account-recovery-handler.php",
			data: {
				fname: resultData.fname,
				answerIsCorrect: answerIsCorrect,
				email: resultData.email,
				password: resultData.password
			},
			success: function(result){

				if(result == "email sent")
					$("#security").empty().append("Success! An email has been sent to " + resultData.email + " with a link allowing you to recover your account.</p>");

				else if(result == "email error")
					$("#security").empty().append("You've successfully answered your security question. We tried sending an email to " + resultData.email + ", but an error occurred. Try submitting again, and if the error persists, <a href='contact-us.php'>contact us</a>. We apologize for the inconvenience.")

				else if(!isNaN(result)){
					result = Number(result);
					$("#security").empty().append("Your security answer is incorrect. You have " + result + " attempts remaining to answer your security question before your account will be temporarily locked.");
				}

				else{
					$("#security").empty().append("You have exceeded the maximum amount of attempts to correctly answer your security question. The amount of time remaining until you can attempt answering your security question again is: " + result + ".");
				}
			},
			error: function(){
				$("#security").empty().append("An error occurred while communicating with the server. Try again later, and if the issue persists, <a href='contact-us.php'>contact us</a>. We apologize for the inconvenience.");
			}
		});
	});
}

function getDataWithName(callback){

	$("#confirm-name").html("<img src='img/icons/ajax-loader.gif'>");
	$serializedName = $("input[name=fname], input[name=lname]").serialize();

	$.ajax({
		type: "post",
		url: "php/account-recovery-handler.php",
		data: $serializedName,
		success: function(resultData){

			// Returned empty set
			if (resultData == "[]"){
				$("#confirm-name").empty().append("The entered first and last name do not match any records in our database.");
			}

			// Returned a string containing "An error occurred"
			else if (resultData.indexOf("An error occurred") > 0){
				$("#confirm-name").empty().append(resultData);
			}

			// If neither above case is true, a json object was returned
			else{
				// resultData is part of an array because it could fetch multiple results if more than one name matches. This would be pretty bad in most cases, but no one in Beta Tau has a matching first and last name. Deal with this if it becomes an issue though.
				var jsonData = jQuery.parseJSON(resultData)[0];
				$("#confirm-name").empty().append("A match under the name " + $("input[name=fname]").val() + " " + $("input[name=lname]").val() + " was found.");
				callback(jsonData);
			}	
		}
	});
}

$(document).ready(function(){

	$("fieldset#answer-security").hide();

	$("#always-show input").change(function(){
		if($("input[name=fname]").val() != "" && $("input[name=lname]").val() != ""){
			getDataWithName(showSecurityQuestion);
		}
	});
});