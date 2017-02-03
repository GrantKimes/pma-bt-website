<?php 
	require "php/config.php";
	require "php/mail-widget.php";

	$highlightAnchors = array("contact-us.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact Us | &#934&#924&#913 &#914&#932 | UMiami</title>
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
			<h3>Contact Us</h3>
			<p>Whether you'd like to learn more about Beta Tau, request a service from us, or simply contact a member of the chapter, we'd love to hear from you. Just fill out the form below and we'll get back to you as soon as possible.</p>

			<p class="small-text"><span class="color-red">Red</span> inputs are required. Inputs will fade to black once filled.</p>

			<?php mailWidget("brotherhood@betataupma.org"); ?>
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
<script type = "text/javascript" src="js/universal-form-handler.js"></script>

</body>
</html>