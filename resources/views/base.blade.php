<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>&#934&#924&#913 UMiami - @yield('title')</title>

	<link rel="icon" type="image/png" href="images/logo.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional Bootstrap theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	
	<!-- My stylesheet -->
	<link rel="stylesheet" href="css/style.css">


	<!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- My Javscript file -->
	<script src="js/script.js" type="text/javascript"></script>


	<!-- Font Awesome icons -->
	<script src="https://use.fontawesome.com/a7115d7118.js"></script>

	<!-- Garamond font -->
	<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:" rel="stylesheet">

	
</head>

<body>


	<!-- Navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>

	      <a class="navbar-brand" href="#">
	        <img src="images/logo.png" id="navbar-logo">
	      </a>
	    </div>

	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="@yield('home_tab')"><a href="{{ route('home') }}">Home</a></li>
	      	<li class="@yield('about_tab')"><a href="{{ route('about') }}">About</a></li>
	      	<li class="@yield('sv_tab')"><a href="{{ route('sv') }}">Singing Valentines</a></li>
	      	<li class="@yield('botb_tab')"><a href="{{ route('botb') }}">Battle of the Bands</a></li>
	      	<!--<li><a>Gallery</a></li>-->
	      </ul>
	    </div>

	  </div>
	</nav>


	<!-- Top section after navbar -->
	<div id="page-header" class="container"> 
		<div class="row">
			<div class="col-md-4">
				<img src="images/Coat-of-Arms.png" id="coat-of-arms" class="img-responsive center-block">
			</div>

			<div class="col-md-4 center-text">
				<h1 class="red title">Phi Mu Alpha Sinfonia</h1>
				<h1 class="black title">Beta Tau Chapter</h1>
				<h1 class="gold title">University of Miami</h1>
			</div>

			<div class="col-md-4 center-text">
				<h3 class="title">Est. 1937</h3>
				<p><i>(Website currently under development)</i></p>
			</div>
		</div>

		<hr>
	</div>



	<!-- Main content, gets filled by each specific page template -->
	@section('content')
	<div class="container">
		<h1>Under development</h1>
	</div>
	@show



	<!-- Footer -->
	<hr>
	<div id="page-footer" class="container">
		<div class="row">
		<!--
			<div class="col-md-6 col-md-offset-3 center-text">
				<p><a href="mailto:brotherhood@betataupma.org">Brotherhood@BetaTauPMA.org</a></p>
				<p><a href="https://www.facebook.com/betatau1937/" target="_blank">Facebook Page</a></p>
				<p><a href="/legacy/index.php">Legacy Site</a></p>
			</div>-->

			<div class="list-group col-md-4 col-md-offset-4 center-text">
				<a href="mailto:brotherhood@betataupma.org" class="list-group-item">Brotherhood@BetaTauPMA.org</a>
				<a href="https://www.facebook.com/betatau1937/" class="list-group-item" target="_blank">Facebook Page</a>
				<a href="/legacy/index.php" class="list-group-item">Legacy Site</a>
			</div>


			<div class="col-md-4 center-block">
				<img src="images/Banner-Among-Men-Harmony.jpg" id="among-men-harmony" class="img-responsive center-block">
			</div>
		</div>
				
	</div>


</body>