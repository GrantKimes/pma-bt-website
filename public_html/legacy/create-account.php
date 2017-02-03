<?php

	require_once "php/config.php";

	// Code for setting a session and redirecting browser to avoid having $_GET variables in the URL.
	if(isset($_GET["sender-fname"]) && isset($_GET["sender-lname"]) && isset($_GET["type"])){

		$_SESSION["sender-fname"] = $_GET["sender-fname"];
		$_SESSION["sender-lname"] = $_GET["sender-lname"];
		$_SESSION["type"] = $_GET["type"];

		// Next lines of html redirect user with JQuery to get rid of get variables in URL for security purposes.
		redirectTo("create-account.php");
	}

	require_once "php/bcrypt.php";
	$highlightAnchors = array();

	function echoIfSet($key){
		if (!empty($_REQUEST[$key]))
			return "'" . $_REQUEST[$key] . "'";

		else
			return '';
	}
 
	function areRequiredInputsSet(){

		$inputNames = array("fname", "lname", "email", "confirm-email", "password", "confirm-password");

		foreach ($inputNames as $inputName){

			if(!isset($_REQUEST[$inputName]))
				return false;
		}

		return true;
	}

	function getAccountType(){

		$possibleAccountTypes = array("probationary", "alumni", "active");
		$bcrypt = new Bcrypt(5);

		foreach($possibleAccountTypes as $possibleType){
			if($bcrypt->verify($possibleType, $_SESSION["type"])){
				return $possibleType;
			}
		}

		return "invalid";
	}

	function reportError($db){
		?>
		<p class="small-text">An error occured while attempting to connect to the database. Attempt submitting again, and if the issue persists please contact an administrator. We apologize for the inconvenience.</p>
		<p class="small-text">Detailed information on the error MAY be displayed below:</p>
		<p class="small-text">
		<?php
		echo($db->connect_error . "</p>");
	}

	function spamcheck($field)
	{
		//filter_var() sanitizes the e-mail
		//address using FILTER_SANITIZE_EMAIL
		$field=filter_var($field, FILTER_SANITIZE_EMAIL);

		//filter_var() validates the e-mail
		//address using FILTER_VALIDATE_EMAIL
		if(filter_var($field, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}

	function validateEmail(){

		// returns true if valid email
		if(spamcheck($_REQUEST["email"]))
			return true;
		else
			return false;
	}

	// Returns the account type's invalidated number using a string specifying the account type.
	function accountTypeToNumber($accountType){

		switch($accountType){

			case "probationary":
				return 0;
			case "alumni":
				return 1;
			case "active":
				return 2;
			default:
				echo("<p>Error in internal code. Your account type could not be converted. Please <a href='report-error.php'>report this error</a>.</p>");
				die;
		}
	}

	// Returns true on success or false on failure.
	function createAccount($accountType){

		$accountType = accountTypeToNumber($accountType);

		try{
			$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
			//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); For debugging

			$stmt = $db->prepare("INSERT INTO users (email, password, fname, lname, accountType, securityQuestion, securityAnswer) VALUES (?, ?, ?, ?, ?, ?, ?)");
			
			$bcrypt = new Bcrypt(15);
			$hashPassword = $bcrypt->hash($_REQUEST["password"]);

			$values = array($_REQUEST["email"], $hashPassword, $_REQUEST["fname"], $_REQUEST["lname"], $accountType, $_REQUEST["security-question"], $_REQUEST["security-answer"]);

			$stmt->execute($values);

			// Close connection
			$db = null;

		} catch (PDOException $e) {
			echo 'An error occured: ' . $e->getMessage();
			return false;
		}

		return true;
	}

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


	function showCreateAccountForm($accountType){
		?>
		<form action="create-account.php" method="post">
			<fieldset>
				<legend>Name</legend>
				<div class='input-horizontal'>
					<label for='fname' class='required'>First Name:</label>
					<input type='text' name='fname' required='required' class='required' maxlength="20" value=<?php echo(echoIfSet("fname"))?>>
				</div>
				<div class='input-horizontal'>
					<label for='lname' class='required'>Last Name:</label>
					<input type='text' name='lname' required='required' class='required' maxlength="20" value=<?php echo(echoIfSet("lname"))?>>
				</div>
			</fieldset>
			<fieldset>
				<legend>Account Information</legend>
					<label for='email' class='required'>Email Address:</label>
					<input type='email' name='email' required='required' class='email required' maxlength="40" value=<?php echo(echoIfSet("email"))?>>
					<label for='email' class='help'>Your email address will be used as your login username.</label>
					<label for="email" id="email-availability"></label>

					<label for='confirm-email' class='required'>Confirm Email Address:</label>
					<input type='email' name='confirm-email' required='required' class='email required' maxlength="40" value= <?php echo(echoIfSet("confirm-email"))?>>
					<label for='confirm-email' class='help'>Your email address will be used as your login username.</label>

					<label for='password' class='required'>Password:</label>
					<input type='password' name='password' required='required' class='password required' maxlength="24" value=<?php echo(echoIfSet("password"))?>>
					<label for='password' class='help'>Must be between 8 and 24 characters long, and include capital letters, lowercase letters, and numbers.</label>

					<label for='confirm-password' class='required'>Confirm Password:</label>
					<input type='password' name='confirm-password' required='required' class='password required' maxlength="24" value=<?php echo(echoIfSet("confirm-password"))?>>
					<label for='confirm-password' class='help'>Must be between 8 and 24 characters long, and include capital letters, lowercase letters, and numbers.</label>
					<p class="small-text"><?php echo($_SESSION["sender-fname"]) ?> indicated that your account type should be <?php echo($accountType) ?>. If this is incorrect, please contact <?php echo($_SESSION["sender-fname"]) ?> and ask him to send you an updated account creation link. Note possible account types are active, alumni, and probationary.</p>
			</fieldset>
			<fieldset>
				<legend>Account Recovery</legend>
				<p class="small-text">Just in case you forget your password, we ask that you pick a security question and answer it if account recovery becomes necessary.</p>
				<select name="security-question">
					<option value="1">In what city or town was your first job?</option>
					<option value="2">What is the name of a college you applied to but didn't attend?</option>
					<option value="3">What is your oldest sibling's middle name?</option>
					<option value="4">What was your childhood nickname?</option>
					<option value="5">What is your maternal grandmother's maiden name?</option>
					<option value="6">What school did you attend for sixth grade?</option>
					<option value="7">What is the last name of your favorite high school teacher?</option>
					<option value="8">What is the middle name of your youngest child?</option>
				</select>
				<label for='security-answer' class='required'>Security Answer:</label>
				<input type='text' name='security-answer' required='required' class='required' maxlength="30" value=<?php echo(echoIfSet("security-answer"))?>>
			</fieldset>
			<div id="warnings"></div>
			<button name='submit' type='submit' disabled="disabled">Submit!</button>
		</form>
		<?php
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create an Account | &#934&#924&#913 &#914&#932 | UMiami</title>
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
			<h3>Create an Account</h3>
			<?php

			$accountType = getAccountType();

			if(areRequiredInputsSet()){

				// Next group of nested if/elses displays any errors that occur during account creation.
				if($noErrorOccurred = validateEmail()){
					$noErrorOccurred = createAccount($accountType);

					if ($noErrorOccurred){

						$noErrorOccurred = sendVerificationEmail($_REQUEST["fname"], $_REQUEST["email"], $_SESSION["type"]);

						if (!$noErrorOccurred){
							?>
							<p>Account creation was successful, but we were unable to send you a confirmation email. Log in and click on the "Resend Confirmation Email" button to try sending the email again. If your email was incorrectly entered, you will also be able to change it from this page.</p>
							<?php
						}
					}
					else{
					?>
						<p>An error occured during account creation. Please try submitting the form again. If the problem persists, <a href="contact-us.php">contact us</a>. We apologize for the inconvenience.</p>
					<?php
					}
				}
				else{
					?>
					<p>We were unable to validate your email. Please ensure that you've properly entered your email. If your email was properly entered and you are still receiving this message, try a different email. If the problem persists, <a href="contact-us.php">contact us</a>. We apologize for the inconvenience.</p>
					<?php
				}
			}

			if(areRequiredInputsSet() && $noErrorOccurred){ 

			?>

				<p>Your information has been submitted! Please check your email for a verification message from us. Once you've clicked the link included in the email, your account will be fully usable.</p>
				<p>Not seeing an email from us? Make sure you check your spam folder. Alternatively, click <a id="show-form" href="#">here</a> to display the account creation form again and ensure that all information was correctly filled out.</p>

			<?php

				if ($_REQUEST["show-form"] == true)
					showCreateAccountForm($accountType); 

			}

			elseif(areRequiredInputsSet() && !$noErrorOccurred){ ?>

			<?php showCreateAccountForm($accountType);

			}

			// Next line of code checks for a sender first and last name, and assigns an accountType based on the given hash in URL. accountType is assigned during the elseif so that it doesn't have to be called again since it is an intensive function.
			elseif (isset($_SESSION["sender-fname"]) && isset($_SESSION["sender-lname"]) && $accountType != "invalid"){ ?>

				<p>
				<?php
				if($accountType == "alumni" || $accountType == "active")
					echo("Hail, Brother! ");
				echo($_SESSION["sender-fname"] . " " . $_SESSION["sender-lname"]); ?> 
				has invited you to make an account on Beta Tau's website. By making an account, you'll gain access to various restricted access parts of the website, have the option to make a short biography for our Meet the Brothers page, among other perks.</p>
				<p>Simply fill out the form below and a confirmation email will be sent to you. Note that this page is only accessible by the link provided to you by another brother, and you will be unable to visit this page again without access to that link.</p>
				<p><span class='color-red'><b>Red inputs are required</b></span>. An input will fade to gray once filled.</p>

			<?php showCreateAccountForm($accountType);

			}

			else{ 
			?>

				<p>We were unable to validate your account creation link. Contact a current member of Beta Tau's website to receive an account creation link, or <a href="contact-us.php">contact us</a>.</p>

			<?php 
			} 
			?>

		</div>
		<div id="side-bar">

		</div>
	</div>
</div>
<?php include "footer.php"; ?>

<!-- Scripts -->
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>
<script type = "text/javascript" src="js/universal-form-handler.js"></script>
<script type = "text/javascript" src="js/create-account-handler.js"></script>

</body>
</html>