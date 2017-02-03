<?php 
	require "php/config.php";
	$highlightAnchors = array("dashboard.php", "account-invite.php");

	function displayHelp(){
		?>
		<p>By generating an account invitation, you can send another brother a link which will allow him to create an account at Beta Tau's website.</p>
		<p>Don't post invites where non-brothers may be able to access them - the entire point of the invite system is to prevent unauthorized people from creating accounts and accessing information they shouldn't be able to!</p>
		<?php
	}

	function displayLinks(){

		
		if (isset($_SESSION["accountType"]))
			$accountType = $_SESSION["accountType"];
		else
			$accountType = -1;

		require "php/bcrypt.php";

		switch ($accountType){

			case 0:
			case 1:
			case 2:
				echo("<p>Verify your account to gain access to this feature.</p>");
				break;
			case 3:
				echo("<p>Probationary members don't have access to this feature.</p>");
				break;
			case 4:
				displayHelp();
				$bcrypt = new Bcrypt(5);
				?>
				<p>As an alumni brother, you can send invites to other alumni by copying and sending them the link below:</p>
				<p class="small-text dash-border">www.betataupma.org/create-account.php?sender-fname=<?php echo($_SESSION["fname"]);?>&amp;sender-lname=<?php echo($_SESSION["lname"]);?>&amp;type=<?php echo($bcrypt->hash("alumni"));?></p>
				<p>Ensure that the entire area inside the box is copied, or the invite won't work.</p>
				<?php
				break;
			case 5:
			case 6:
				displayHelp();
				?>
				<p>Active brothers can send invites to other actives, alumni, and probationary members. Simply select which link type you'd like to send:</p>
				<fieldset>
					<legend>Invite Type</legend>
					<div class='input-radio'>
						<input type='radio' name='type' value='active'>
						<label for='type'>Active</label>
					</div>
					<div class='input-radio'>
						<input type='radio' name='type' value='alumni'>
						<label for='type'>Alumni</label>
					</div>
					<div class='input-radio'>
						<input type='radio' name='type' value='probationary'>
						<label for='type'>Probationary</label>
					</div>
				</fieldset>
				<p class="small-text dash-border" id="invite-box"></p>
				<p>Ensure that the entire area inside the box is copied, or the invite won't work.</p>
				<?php
				break;
			default:
				echo("<p>You must be logged in to access this page.</p>");
		}
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
			<h3>Create an Account Invitation</h3>
			<?php displayLinks(); ?>
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
<script type = "text/javascript" src="js/create-invite.js"></script>

</body>
</html>