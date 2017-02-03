<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a Bio for the Bros Page | Phi Mu Alpha Sinfonia | Beta Tau Chapter | University of Miami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
</head>
<body>

<div id="master-container">
	<header>
		<img id="crest" src="img/pma-crest.png" alt="Phi Mu Alpha Sinfonia Crest">
		<h1>
			<span class="color-red">Phi Mu Alpha Sinfonia</span><br>
			<span class="color-black">Beta Tau Chapter</span><br>
			<span class="color-gold">University of Miami</span>
		</h1>
		<nav>
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="about-us.php">About Us</a>
					<ul>
						<li><a href="national-pma.php">National Organization</a></li>
						<li><a href="about-beta-tau.php">The Beta Tau Chapter</a></li>
					</ul>
				</li>
				<li><a href="meet-bros.php">Meet the Brothers</a></li>
				<li><a href="calendars.php">Calendar of Events</a></li>
				<li><a href="services.php">Services</a>
					<ul>
						<li><a href="booking.php">Booking</a></li>
						<li><a href="community-service.php">Community Service</a></li>
						<li><a href="concerts.php">Concerts</a></li>
						<li><a href="valentines.php">Singing Valentines</a></li>
					</ul>
				</li>
				<li><a href="merch.php">Merch</a></li>
				<li><a href="media.php">Media</a></li>
				<li><a href="media.php">Log In</a></li>
				<li><a href="contact-us.php">Contact Us</a></li>
			</ul>
		</nav>
		<hr>
	</header>

	<div id="content-container">
		<div id="main">
			<h3>Create a Bio for the Meet the Brothers Page</h3>
			<?php require "php/add-bro-handler.php"; ?>
		</div>
		<div id="side-bar">
			<h4>Your Bio:</h4>
			<h4><span id="fname-preview">Your</span> <span id="mname-preview"></span> <span id="lname-preview">Name</span></h4>
			<p id="hometown-preview">Hometown: </p>
			<p id="pledge-class-preview">Pledge Class: </p>
			<p id="major-preview">Major: </p>
			<p id="grad-date-preview">Graduation Date:</p>
			<p id="curr-position-preview"></p>
			<p id="past-position-preview"></p>

			<h4>An example bio:</h4>
			<h4>Austin Michael Clifton</h4>
			<p>Hometown: New Smyrna Beach, Florida</p>
			<p>Pledge Class: Fall 2012</p>
			<p>Major: Computer Engineering</p>
			<p>Graduation Date: Spring 2016</p>
		</div>
	</div>
</div>

<!-- Scripts -->
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>
<script type = "text/javascript" src="js/form-handler.js"></script>
<script type = "text/javascript" src="js/loadxmldoc.js"></script>

</body>
</html>