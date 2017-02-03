<?php 
	require "php/config.php";
	$highlightAnchors = array("about-us.php", "about-beta-tau.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>About Beta Tau | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
	<noscript><link rel="stylesheet" href="css/no-script-style.css"></noscript>
</head>

<body>
<div id="master-container">
	<?php require "html-header.php"; ?>

	<noscript><img src="img/banners/75th-concert.jpg" alt="Beta Tau's 75th Anniversary concert"></noscript>

	<div id="img-rotator">
		<img class="rotator-img" src="img/banners/75th-concert.jpg" alt="Beta Tau's 75th Anniversary concert">
		<img class="rotator-img" src="img/banners/moses-award.jpg" alt="Beta Tau's former faculty advisor, Dean Kenneth Moses, receives an award for his devotion to the chapter">
		<img class="rotator-img" src="img/banners/canoe-trip.jpg" alt="Beta Tau brothers from present and past gather for the annual canoe trip">
		<img class="rotator-img" src="img/banners/final-cut.jpg" alt="Brothers Jon Sheairs, Russell Klein, Max Molander, and Austin Clifton jam out to Coheed and Cambria's 'Final Cut'">
		<img id="prev-button" src="img/icons/left-arrow.png" alt="Previous Picture Button">
		<img id="next-button" src="img/icons/right-arrow.png" alt="Next Picture Button">
	</div>

		<div id="content-container">
		<div id="main">
			<h3>The Beta Tau Legacy</h3>
			<p>Founded March 5, 1937 the Beta Tau chapter of Phi Mu Alpha Sinfonia is one of the oldest collegiate chapters of the Fraternity. As the first men’s fraternal organization at the University of Miami, it helped establish many of the on campus traditions including O-Cheer and the dedication of the Alma Mater Plaque that can be seen in the UC breezeway.</p>

			<p>Like most of the National Fraternity, the Beta Tau chapter has brought many famous members into the fold and rich history of the chapter. The likes of Luciano Pavarotti, former music school dean Ken Moses, Sam Pilafian (newly confirmed member of Boston Brass), Jay Pearson (former president of the university), and Henry King Stanford (former president of the university) are all members of the Beta Tau Chapter.

			<p>While many members originate from the the music school, the fraternity boasts members from virtually every college or major at the University including Engineering, Poetry, Biology, Neuroscience, Communications, and even the medical school to name a few.</p>

			<p>In spring of 2012 the Beta Tau chapter celebrated its 75th anniversary on campus and since fall of 2013 the chapter has initiated over 1000 members with 26 currently active members.</p>
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
<script type = "text/javascript" src="js/rotator.js"></script>

</body>
</html>