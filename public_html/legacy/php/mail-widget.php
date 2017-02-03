<?php

	// Simply echoes a mail form.
	function displayMailForm(){
		?>

		<form action="contact-us.php" method="post">
				<label class="required" for="email">Email:</label>
				<input class="required" name="email" type="text" id="email" required="required">
				<label class="required" for="subject">Subject:</label>
				<input class="required" name="subject" type="text" id="subject" required="required">
				<label class="required" for="message">Your message:</label>
				<textarea class="required" name="message" cols="50" rows="4" id="message" required="required"></textarea>
				<button type="submit" name="submit" value="Submit">Submit</button>
				<br>
		</form>

		<?php
	}

	// Checks email address to sanitize it. For safety, I think, but I pulled this code from W3Schools and didn't write it myself, soo...
	function spamcheck($field){
		$field = filter_var($field, FILTER_SANITIZE_EMAIL);

		if(filter_var($field, FILTER_VALIDATE_EMAIL))
			return true;

	  	else
	  		return false;
	}

	// Displays mail form if first visit to page. If info submitted, attempts to send an email and displays results.
	// Parameters: $email is a string and email to send to
	// "Mother" function for this php file.
	function mailWidget($email){

		if (isset($_REQUEST['email']) && isset($_REQUEST['message']) && isset($_REQUEST["subject"])){

			if (!spamcheck($_REQUEST['email'])){

				echo "<p>Please make sure your email address is correct - we were unable to validate it. If this message continues to appear, try a different email address, or contact us manually at <a href='$email'>$email</a>. We apologize for any inconvenience.</p>";

				displayMailForm();
			}

			else{

				$sender = $_REQUEST["email"];
				$subject = $_REQUEST["subject"];

				mail($email, $subject, $_REQUEST["message"], "From: $sender");
				echo "<p>Your message has been sent! Thank you for contacting us.</p>";
			}

		}

		else{
			displayMailForm();

			if(isset($_REQUEST["submit"]))
				echo "<p class='small-text'>Please ensure that all fields are filled out before submission</p>";
		}
	}

?>