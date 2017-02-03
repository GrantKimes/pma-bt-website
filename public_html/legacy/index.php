<?php
	$highlightAnchors = array("index.php"); // Defines all anchors in the nav which should be given class selected.
	require "php/config.php";
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
	<noscript><link rel="stylesheet" href="css/no-script-style.css"></noscript>
</head>

<body>
<div id="master-container">
	<?php require "html-header.php"; ?>

	<noscript><img src="img/banners/seniors.jpg" alt="Beta Tau Spring 2012 Graduates"></noscript>

	<div id="img-rotator">
		<img class="rotator-img" src="img/banners/sebastian-rat.jpg" alt="Bros and sweetheart Andie Cohn hanging out at the Rat with Sebastian">
		<img class="rotator-img" src="img/banners/fall-12.jpg" alt="The fall '12 pledge class reunites at informal rush">
		<img class="rotator-img" src="img/banners/bros-with-moses.jpg" alt="Beta Tau brothers hanging out before a concert">
		<img class="rotator-img" src="img/banners/seniors.jpg" alt="Beta Tau Spring 2012 Graduates">
		<img class="rotator-img" src="img/banners/serenade.jpg" alt="Brothers serenade Beta Tau sweethearts Ashley Dixon and Andie Cohn">
		<img class="rotator-img" src="img/banners/fall-11.jpg" alt="The fall '11 pledge class shows some pride">
		<img id="prev-button" src="img/icons/left-arrow.png" alt="Previous Picture Button">
		<img id="next-button" src="img/icons/right-arrow.png" alt="Next Picture Button">
	</div>

	<div id="content-container">
		<div id="main">
			<h3>Welcome to Beta Tau's chapter website</h3>

			
		</div>
		<div id="side-bar">
		</div>
	</div>
</div>
<br>
<?php include "footer.php"; ?>

<!-- Scripts -->
<!-- Fix the next two scripts to disclude http: when you upload them. -->
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>
<script type = "text/javascript" src="js/rotator.js"></script>

</body>
</html>