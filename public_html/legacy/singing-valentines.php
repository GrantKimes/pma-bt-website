<?php 
	require "php/config.php";
	$highlightAnchors = array("singing-valentines.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Singing Valentines | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
	<noscript><link rel="stylesheet" href="css/no-script-style.css"></noscript>
</head>
<body>

<div id="master-container">
	<?php require "html-header.php"; ?>

	<noscript><img src="img/banners/heart-costume.jpg" alt="A completed night of singing with the iconic heart costume"></noscript>

	<div id="img-rotator">
        <img class="rotator-img" src="img/banners/max_heart.jpg">
        <img class="rotator-img" src="img/banners/dr_page_sv.jpg">
        <img class="rotator-img" src="img/banners/kkg_chris.jpg">
        <img class="rotator-img" src="img/banners/lc.jpg">
		<img class="rotator-img" src="img/banners/sorority-valentines.jpg" alt="Brother Tomas Ramos serenades a sister of Delta Phi Epsilon">
		<img class="rotator-img" src="img/banners/heart-costume.jpg" alt="A completed night of singing with the iconic heart costume">
		<img class="rotator-img" src="img/banners/yip-valentines.jpg" alt="Brother Stephen Yip serenades a surprised student in class">
		<img class="rotator-img" src="img/banners/tomas-andie.jpg" alt="Brother Tomas Ramos serenades Beta Tau's sweetheart, Andie Cohn">
        <img class="rotator-img" src="img/banners/bad_sv.jpg">
        <img id="prev-button" src="img/icons/left-arrow.png" alt="Previous Picture Button">
		<img id="next-button" src="img/icons/right-arrow.png" alt="Next Picture Button">
	</div>

	<div id="content-container">
		<div id="main">
			<h3>Singing Valentines</h3>

			<p>Every year on Valentine's Day and the two days preceding it, Beta Tau has Singing Valentines, its biggest fundraiser of the year and a tradition that many Phi Mu Alpha chapters across the country do. We offe a selection of three or four songs arranged in four-part harmony, and then send a group of brothers into a classroom at a scheduled time and serenade the recipient. We also deliver a rose with each song!</p>

			<p>Songs are sold up until Valentines Day and usually delivered on or the two days before Valentine's Day. The fun is that they can be very romantic, or very embarrassing. It can be a last minute gift for a significant other, or a gag joke to play on one of your friends. We even sing to professors! Be sure to book your Singing Valentines as early as possible because the schedule fills up very fast.</p>

			<p>Look out for Newly Initiated Brothers wearing the Giant Heart Costume!</p>

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