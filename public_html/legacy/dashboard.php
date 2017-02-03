<?php 
	require "php/config.php";
	$highlightAnchors = array("dashboard.php");

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

	// Converts accountType number value (used for MySQL) into hashed string type for email verification.
	function accountNumberToHashedType($accountNumber){

		require_once "php/bcrypt.php";

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

	function showDashboardWelcome($fname){
		?>
		<p>Welcome to your dashboard, <?php echo($fname) ?>. </p>
		<?php
	}

	function showMailSent($mailSuccess){
		if($mailSuccess){
			echo("<p>A verification email has been successfully sent! Check your email for it and visit the included link to verify your account.</p>");
		}
		else{
			echo("<p>An error occurred while attempting to send your email. Try sending the verification email again. If the problem persists, <a href='report-error.php'>report this error</a>.");
		}
	}

	function showVerificationEmail(){

		// For JavaScript disabled browsers. If sendEmail is set and true
		if(isset($_GET["sendEmail"]) && $_GET["sendEmail"]){
			$mailSuccess = sendVerificationEmail($_SESSION["fname"], $_SESSION["email"], accountNumbertoHashedType($_SESSION["accountType"]));
			showMailSent($mailSuccess);
		}

		showDashboardWelcome($_SESSION["fname"]);
		?>
		<p>Our records show that you haven't verified your account yet! In order to use login features, you'll need to access the email you registered your account with and visit the provided verification link.</p>
		<p>If you never received an email, or need us to send you a new one, click 
			<span id="sendVerificationEmail" class="fake-anchor"></span>
			<noscript><a href="dashboard.php?sendEmail=true">here</a></noscript>
			.
		</p>
		<p id="ajaxNotifier"></p>
		<?php
	}

	function showDashboard(){

		showDashboardWelcome($_SESSION["fname"]);

	}

	function showAdminDashboard(){

		showDashboardWelcome($_SESSION["fname"]);

	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Phi Mu Alpha | Beta Tau | About Us</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
	<noscript><link rel="stylesheet" href="css/no-script-style.css"></noscript>
</head>

<body>
<div id="master-container">
	<?php require "html-header.php"; ?>

		<div id="content-container">
		<div id="main">
			<?php 
				if (!isset($_SESSION["accountType"])){
					echo("<p>You must be logged in to view this page.</p>");
				}
				elseif($_SESSION["accountType"] < 3){
					showVerificationEmail();
				}
				elseif($_SESSION["accountType"] >= 3 && $_SESSION["accountType"] < 6){
					showDashboard();
				}
				elseif($_SESSION["accountType"] == 6){
					showAdminDashboard();
				}
			 ?>
		</div>
		<div id="side-bar">

		</div>
	</div>
</div>
<?php include "footer.php"; ?>

<!-- Scripts -->
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>
<script type = "text/javascript" src="js/ajax-verification-email.js"></script>

</body>
</html>