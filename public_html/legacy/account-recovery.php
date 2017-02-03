<?php
	require "php/config.php";
	$highlightAnchors = array();

	function displayRecoveryForm(){
		?>
		<p>If you've forgotten your login email or password, simply fill out the form below and an email will be sent to the address linked to your account with a link allowing you to reset your password. If you are unable to access the email linked to your account, you will need to <a href="contact-us.php">contact us</a> to reset your email and/or password.</p>
		<div id="recovery-box">
			<fieldset id="always-show">
				<legend>Name</legend>
				<p class="small-text">What is your first and last name?</p>
				<div class='input-horizontal'>
					<label for='fname'>First Name:</label>
					<input type='text' name='fname' maxlength="20">
				</div>
				<div class='input-horizontal'>
					<label for='lname'>Last Name:</label>
					<input type='text' name='lname' maxlength="20">
				</div>
				<p class="small-text" id="confirm-name"></p>
			</fieldset>
			<fieldset id="answer-security">
				<legend>Answer Your Security Question</legend>
				<p class="small-text" id="security-question"></p>
				<label for='security-answer'>Answer:</label>
				<input type='text' name='security-answer' maxlength="20">
				<button name='verify-security-answer' type='submit'>Verify Answer</button>
				<p class="small-text" id="security"></p>
			</fieldset>
		</div>
		<?php
	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account Recovery | &#934&#924&#913 &#914&#932 | UMiami</title>
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
			<h3>Recover Your Account</h3>

			<?php 
			if(isset($_SESSION["email"])){
				echo("<p>You're already logged in!</p><p>If you need to edit your account information, do so from your dashboard.</p>");
			}
			else{ 
				displayRecoveryForm();
			}
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
<script type = "text/javascript" src="js/account-recovery.js"></script>

</body>
</html>