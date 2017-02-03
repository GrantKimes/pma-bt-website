$(document).ready(function(){

	$("#sendVerificationEmail").html("here");

	$("#sendVerificationEmail").click(function(){

		$("#ajaxNotifier").html("<img src='img/icons/ajax-loader.gif'>");

		$.ajax({
	        type:"post",
	        url:"php/ajax-send-verification-email.php",
	        data:"sendEmail=" + "true",
	        success:function(data){

	        	if(data == true){
	        		$("#ajaxNotifier").html("An account verification email has successfully been sent! Check your account linked email for the message.");
	        	}

	        	else
	        		$("#ajaxNotifier").html("An error occurred while attempting to send an email to your linked account. Try again, and if this issue persists, <a href='contact-us.php'>contact us</a> and we'll help you sort out account verification.");
	        	
	        }
	    });
	});

});