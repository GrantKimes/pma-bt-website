<?php 
	require "php/config.php";
	$highlightAnchors = array("meet-bros.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Phi Mu Alpha | Beta Tau | Meet the Brothers</title>
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
			<h3>Meet the Bros of Beta Tau</h3>
			<h4>Add yourself to this page...</h4>
			<p>Brothers: click <a href="edit-bro.php">here</a> to fill out a bio page.</p>
			<p>Click on a brother to expand their info section, or sort brothers <span id="sort-pointer">using the sort menu</span>.</p>
			<h4>Active Brothers</h4>
			<div id="bro-bios"></div>
		</div>
		<div id="side-bar">
			<div id="bro-sorter">
				<p>Sort brothers by...</p>
				<ul>
					<li class="selected-sorter">
						<p>Alphabet</p>
					</li>
					<li>
						<p>Graduating Date</p>
					</li>
					<li>
						<p>Pledge Class</p>
					</li>
					<li>
						<p>Executive Board</p>
					</li>
					<li>
						<p>Alumni</p>
					</li>
				</ul>
				<p class = "small-text" id="active-sort">Currently sorting by alphabet in descending order.</p>
			</div>
			<div id="bro-info-drop"></div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>

<!-- Scripts -->
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>
<script type = "text/javascript" src="js/loadxmldoc.js"></script>
<script type = "text/javascript" src="js/active-bros.js"></script>

</body>
</html>