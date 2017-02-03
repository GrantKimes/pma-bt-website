<?php 

require_once "config.php";

function sendVerificationEmail($fname, $email, $accountType){

	$message = "<h2>Hey, " . $fname . "!</h2>". "<br>" . "<p>This email is from the Beta Tau chapter of Phi Mu Alpha, validating your new account on our website at betataupma.org. Click the link below to validate your account and start using all of our website's features.</p><p>www.betataupma.org/validate-account.php?email=" . $email . "&type=" . $accountType . "</p><p>Hope to see you on the website soon!</p><h3>Beta Tau | Phi Mu Alpha Sinfonia | University of Miami</h3>";

	//Set mail type to allow html formatting.
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'To: ' . $email . "\r\n";
	$headers .= 'From: ' . "help@betataupma.org" . "\r\n";

	$mailSuccess = mail($_REQUEST["email"], "Verify Your Account at betataupma.org", $message, $headers);
	return $mailSuccess;
}

function accountNumberToHashedType($accountNumber){

	require_once "bcrypt.php";

	$accountType = null;

	switch($accountNumber){

		case "0":
			$accountType = "probationary";
			break;
		case "1":
			$accountType = "alumni";
			break;
		case "2":
			$accountType = "active";
			break;
		default:
			echo("An internal error has occurred within server scripts. You should <a href='report-error.php'>report this error</a>.");
			die;
	}

	$bcrypt = new Bcrypt(5);

	return $bcrypt->hash($accountType);
}

if(isset($_REQUEST["sendEmail"]) && $_REQUEST["sendEmail"] == "true"){

	$mailSuccess = sendVerificationEmail($_SESSION["fname"], $_SESSION["email"], accountNumbertoHashedType($_SESSION["accountType"]));
	echo($mailSuccess);
}


 ?>