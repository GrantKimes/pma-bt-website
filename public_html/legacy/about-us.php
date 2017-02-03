<?php 
	require "php/config.php";
	$highlightAnchors = array("about-us.php");
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
			<h3>About Us</h3>
			<h4>A Brief History</h4>
			<p>Phi Mu Alpha Sinfonia was founded on October 6, 1898, at the New England Conservatory in Boston, Massachusetts, under founding father Ossian Everett Mills, affectionately called "Father Mills". On March 5, 1937, the University of Miami's Beta Tau Chapter was founded. Beta Tau is one of the oldest active chapters of Phi Mu Alpha, and celebrated its 75th anniversary in 2012. Since fall of 2013, the Beta Tau chapter has admitted over 1,000 men.</p>

			<h4>The Object</h4>
			<p>The Object of this Fraternity shall be for the development of the best and truest fraternal spirit; the mutual welfare and brotherhood of musical students; the advancement of music in America and a loyalty to the Alma Mater.</p>


			<!-- Eventually make these into nicer looking buttons -->
			<h4>National Organization</h4>
			<p><a href="national-pma.php">Read more about Phi Mu Alpha Sinfonia's national organization.</a></p>

			<h4>The Beta Tau Chapter</h4>
			<p><a href="about-beta-tau.php">Read more about the Beta Tau chapter.</a></p>

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