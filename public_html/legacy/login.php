<?php

	require_once "php/config.php";
	require_once "php/bcrypt.php";
	require_once "php/update-login-attempts.php";
	$highlightAnchors = array("login.php");

	// HTML for login form.
	function displayLoginForm(){
		?>
		<form action="login.php" method="post">
			<fieldset>
				<legend>Log In</legend>
				<label for="email">Email:</label>
				<input type="text" name="email" required="required" class="required">
				<label for="password">Password:</label>
				<input type="password" name="password" required="required" class="required">
				<br>
				<button type="submit" name="submit">Log In</button>
			<p class="small-text"><a href="account-recovery.php">Forgot email/password?</a></p>
			</fieldset>
		</form>
		<?php
	}

	function reportError($db){
		?>
		<p class="small-text">An error occured while attempting to connect to the database. Attempt submitting again, and if the issue persists please contact an administrator. We apologize for the inconvenience.</p>
		<p class="small-text">Detailed information on the error MAY be displayed below:</p>
		<p class="small-text">
		<?php
		echo($db->connect_error . "</p>");
	}

	function confirmMembership(){

		$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if($db->connect_errno){
			reportError($db);
    		die();
    	}

    	if($queryResult = $db->prepare("SELECT email, password, fname, lname, accountType FROM users WHERE email = ?")){
	    	$queryResult->bind_param("s", $_REQUEST["email"]);
			$queryResult->execute();
			$queryResult->bind_result($emailMatch, $userPassword, $fname, $lname, $accountType);
			$queryResult->fetch();
			$queryResult->free_result();
			$db->close();
		}

		else{
			reportError($db);
			displayLoginForm();
			die();
		}

    	if (isset($emailMatch)){ // If a match was found, otherwise this will evaluate false as num_rows will be 0.

    		$bcrypt = new Bcrypt(15);

    		// returns true if hashed pw matches
    		if ($bcrypt->verify($_REQUEST["password"], $userPassword)){

    			// Will return time until login can be attempted again if does not reset login attempts
    			$failureMessage = updateLoginAttempts($emailMatch, true);

    			// if user has current attempts remaining for login
    			$loginInfo[] = getRemainingAttemptsAndLastFail($emailMatch);

    			if($loginInfo[0] > 0){

	    			$_SESSION["email"] = $emailMatch;
	    			$_SESSION["fname"] = $fname;
	    			$_SESSION["lname"] = $lname;
	    			$_SESSION["accountType"] = $accountType;
	    			$_SESSION["created"] = time();

	    			if(isset($_SESSION["urlRedirect"])){
	    				redirectTo($_SESSION["urlRedirect"]);
	    			}
	    			else{
	    				redirectTo("dashboard.php");
	    			}
	    		}

    			else{
    				displayLoginForm();
    				?>
    				<p class="small-text">You've exceeded your maximum password attempts and have been locked out of your account. Try again in <?php echo($failureMessage); ?>. If you've forgotten your email or password, you can recover them <a href="account-recovery.php">here</a>. However, you'll still need to wait for your account lockout to expire before recovering your account.</p>
    				<?php
    			}
    		}

    		else{
    			$failureMessage = updateLoginAttempts($emailMatch, false);
    			displayLoginForm();

    			// If $failureMessage is a string then updateLoginAttempts returned a formatted DateTime string with a lockout time.
  				if (is_string($failureMessage)){
  					?>
  					<p class="small-text">You've exceeded your maximum password attempts and have been locked out of your account. Try again in <?php echo($failureMessage) ?>. If you've forgotten your email or password, you can recover them <a href="account-recovery.php">here</a>. However, you'll still need to wait for your account lockout to expire before recovering your account.</p>
  					<?php
  				}

  				// Otherwise $failureMessage will be an int telling how many login attempts remain.
  				else{
  					?>
					<p class="small-text">The entered password is incorrect. You have <?php echo($failureMessage) ?> attempts remaining to correctly enter your password. If you've forgotten your email or password, you can recover them <a href="account-recovery.php">here</a>.</p>
  					<?php
  				}
    		}
    	}

    	else{
    		displayLoginForm();
    		?>
    		<p class="small-text">The entered email is not linked to any accounts in our database. If you've forgotten your email or password, you can recover them <a href="account-recovery.php">here</a>.</p>
    		<?php
    	}
	}
 ?>

 <!doctype html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In | &#934&#924&#913 &#914&#932 | UMiami</title>
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
			<h3>Brother Log In</h3>
			<?php 

				if (!empty($_REQUEST["email"]) && !empty($_REQUEST["password"]))
					confirmMembership();

				elseif ((empty($_REQUEST["email"]) || empty($_REQUEST["password"])) && isset($_REQUEST["submit"])){
					displayLoginForm();

					echo("<p class='small-text'>Please enter an email and password.</p>");
				}

				else
					displayLoginForm();
			?>
		</div>
		<div id="side-bar">
		</div>
	</div>
</div>
<?php include "footer.php"; ?>

<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>

</body>
</html>