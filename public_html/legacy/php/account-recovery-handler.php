<?php 

	require_once "config.php";
	require_once "update-login-attempts.php";

	function sendRecoveryEmail(){

		$message = "<h2>Hey, " . $_REQUEST["fname"] . "!</h2>". "<br>" . "<p>This email is from the Beta Tau chapter of Phi Mu Alpha. You filled out an account recovery form, so we're sending you a link through which you'll be able to recover your account.</p><p><a href='www.betataupma.org/recover-account.php?email=" . $_POST["email"] . "&amp;password=" . $_POST["password"] . "'>Recover your account!</a></p><p>Hope to see you back on the website soon!</p><h3>Beta Tau | Phi Mu Alpha Sinfonia | University of Miami</h3>";

		//Set mail type to allow html formatting.
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: ' . $_REQUEST["email"] . "\r\n";
		$headers .= 'From: ' . "help@betataupma.org" . "\r\n";

		$mailSuccess = mail($_REQUEST["email"], "Recover Your Account | Beta Tau PMA", $message, $headers);
		return $mailSuccess;
	}

	// Handles ajax request when searching database for first and last name match.
	if (isset($_POST["fname"]) && isset($_POST["lname"])){

		try{
			$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // For debugging, disable when not needed.

			$stmt = $db->prepare("SELECT email, password, fname, lname, securityQuestion, securityAnswer FROM users WHERE fname = ? AND lname = ?");

			// Searches database for users with posted fname and lname.
			$stmt->execute([$_POST["fname"], $_POST["lname"]]);
			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

			// Close connection
			$db = null;

			echo(json_encode($users)); // Returns to jQuery a json_encoded array of users with the given first and last name.
			exit;

		} catch (PDOException $e) {
			echo 'An error occurred. If this issue persists, contact us. We apologize for the inconvenience. Detailed error message is: ' . $e->getMessage();
			die;
		}
	}

	// Handles ajax request when verifying security answer.

	if(isset($_POST["answerIsCorrect"])){

		$remainingAttempts = updateLoginAttempts($_POST["email"], $_POST["answerIsCorrect"]);

		// If $remainingAttempts is an string the max login attempts were exceeded and the string formatted DateTime until next available attempt was returned.
		if (is_string($remainingAttempts)){
			echo($remainingAttempts);
			exit;
		}

		// Otherwise check if security answer is correct and send an email if it is.
		else if($_POST["answerIsCorrect"] == "true"){

			if(sendRecoveryEmail()){
				echo("email sent");
				exit;
			}

			else{
				echo("email error");
				exit;
			}
		}

		// If security answer is incorrect echo the remaining attempts.
		else{
			echo($remainingAttempts);
			exit;
		}
	}

 ?>