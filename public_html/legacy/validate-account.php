<?php 
	require_once "php/config.php";
	require_once "php/bcrypt.php";

	function getAccountType(){

		$possibleAccountTypes = array("probationary", "alumni", "active");
		$bcrypt = new Bcrypt(5);

		// Account number is the permissions that are allowed to each successive account type. 1: probationary, 2: alumni, 3: active
		$accountNumber = 3;
		foreach($possibleAccountTypes as $possibleType){
			if($bcrypt->verify($possibleType, $_SESSION["validate-type"])){
				return $accountNumber;
			}
			$accountNumber++;
		}

		return "invalid";
	}

	function validateAccount(){

		try{
			$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // For debugging, disable when not needed.

			$stmt = $db->prepare("SELECT email FROM users WHERE email = ?");
			$stmt->execute(array($_SESSION["validate-email"]));
			$emailMatch = $stmt->fetch(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			echo 'An error occurred during database communication. Try clicking the link again. If this issue persists, contact us. We apologize for the inconvenience. Detailed error message is: ' . $e->getMessage();
			die;
		}

		// If a match was found, otherwise will be false
		if($emailMatch){

			$accountTypeNumber = getAccountType();

			if ($accountTypeNumber != "invalid"){

				try{
					$stmt = $db->prepare("UPDATE users SET accountType = ? WHERE email = ?");
					$stmt->execute(array($accountTypeNumber, $_SESSION["validate-email"]));

					// Close connection
					$db = null;

				} catch (PDOException $e) {
					echo "An error occured during database communication. Try clicking the link again. If this issue persists, contact us. We apologize for the inconvenience. Detailed error message is: " . $e->getMessage();
				}

				echo("Your account has been validated! Now you can <a href='login.php'>log in</a>!");
			}

			else{
				echo("We were unable to validate information from the link. Make sure that you copied the entire link into the URL. If this issue persists, <a href='contact-us.php'>contact us</a>. Line 68.");

				// Close connection
				$db = null;
			}
		}

		else{
			echo("We were unable to validate information from the link. Make sure that you copied the entire link into the URL. If this issue persists, <a href='contact-us.php'>contact us</a>. Line 76.");
		}
	}

	if(isset($_GET["email"]) && isset($_GET["type"])){

		$_SESSION["validate-email"] = $_GET["email"];
		$_SESSION["validate-type"] = $_GET["type"];

		redirectTo("validate-account.php");
	}

 ?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validate Your Account | &#934&#924&#913 &#914&#932 | UMiami</title>
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
		<h3>Validate Your Account</h3>
		<p>
			<?php

				if(isset($_SESSION["validate-email"]) && isset($_SESSION["validate-type"]))
					validateAccount();
			 ?>
		</p>
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

</body>
</html>