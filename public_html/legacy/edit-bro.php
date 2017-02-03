<?php 
	require "php/config.php";
	$highlightAnchors = array("dashboard.php", "edit-bro.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Your Bio | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
</head>
<body>

<div id="master-container">
	<?php require "html-header.php"; ?>

	<div id="content-container">
		<div id="main">
			<h3>Edit Your Bio</h3>
			<?php require "php/edit-bro-handler.php"; ?>
		</div>
		<div id="side-bar">
			<!-- The below html within the #bio-preview div works with JavaScript to dynamically update the bio preview. -->
			<div id="bio-preview">
				<h4>Your Bio:</h4>
				<h4><span id="fname-preview">Your</span> <span id="mname-preview"></span> <span id="lname-preview">Name</span></h4>
				<p>Hometown: <span id="hometown-preview"></span></p>
				<p>Pledge Class: <span id="pledge-class-semester-preview"></span> <span id="pledge-class-year-preview"></span></p>
				<p>Major: <span id="major-preview"></span></p>
				<p>Minor: <span id="minor-preview"></span></p>
				<p>Graduation Date: <span id="grad-date-semester-preview"></span> <span id="grad-date-year-preview"></span></p>
				<p>Current Position: <span id="curr-position-preview"></span></p>
				<p>Past Position: <span id="past-position-preview"></span></p>
			</div>

			<h4>An example bio:</h4>
			<h4>Music Cat Dude</h4>
			<p>Hometown: Music Land, Florida</p>
			<p>Pledge Class: Fall 2012</p>
			<p>Major: Veterinary Medicine</p>
			<p>Minor: Music Performance</p>
			<p>Graduation Date: Spring 2016</p>
			<p>Current Position: Cat Caretaker</p>
			<p>Past Position: Assistant Cat Caretaker</p>
		</div>
	</div>
	<?php include "footer.php"; ?>
</div>

<!-- Scripts -->
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>
<script type = "text/javascript" src="js/universal-form-handler.js"></script>
<script type = "text/javascript" src="js/edit-bro-handler.js"></script>
<script type = "text/javascript" src="js/loadxmldoc.js"></script>

</body>
</html>