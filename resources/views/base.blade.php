<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>&#934&#924&#913 UMiami - @yield('title')</title>

	<!--<link rel="icon" type="image/png" href="/images/logo.png">-->
	<link rel="icon" type="image/x-icon" href="/images/favicon.ico">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional Bootstrap theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	
	<!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Font Awesome icons -->
	<script src="https://use.fontawesome.com/a7115d7118.js"></script>

	<!-- Garamond font -->
	<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:" rel="stylesheet">


	@section('additional_includes')
	@show


	<!-- My stylesheet -->
	<link rel="stylesheet" href="/css/style.css">

	<!-- My Javscript file -->
	<script src="/js/script.js" type="text/javascript"></script>

</head>

<body>


	<!-- Navbar -->
	<nav class="navbar navbar-default">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>

	      <a class="navbar-brand" href="{{ route('home') }}" title="Beta Tau Home">
	        <img src="/images/logo.png" id="navbar-logo">
	      </a>
	      <a class="navbar-brand" href="https://www.facebook.com/betatau1937/" target="_blank" title="Facebook">
	        <img src="/images/icons/Facebook-black.svg">
	      </a>
	      <a class="navbar-brand" href="https://www.instagram.com/pma_umiami/" target="_blank" title="Instagram">
	        <img src="/images/icons/Instagram-black.svg">
	      </a>
	    </div>

	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="@yield('home_tab')"><a href="{{ route('home') }}">Home</a></li>
	      	<li class="@yield('about_tab')"><a href="{{ route('about') }}">About</a></li>
	      	<!--<li class="@yield('concerts_tab')"><a href="{{ route('concerts') }}">Concerts</a></li>-->
	      	<li class="@yield('sv_tab')"><a href="{{ route('singingValentines') }}">Singing Valentines</a></li>
			@if (Auth::check()) 
		      	<li class="@yield('sv_order_tab')"><a href="{{ route('create_order') }}">Order</a></li>
		      	<li class="@yield('sv_view_tab')"><a href="{{ route('view_orders') }}">View</a></li>
		      	@if (Auth::user()->name == "admin")
			      	<li class="@yield('sv_edit_tab')"><a href="{{ route('edit_orders') }}">Edit</a></li>
		      	@endif
			@endif
	      	<li class="@yield('botb_tab')"><a href="{{ route('botb') }}">Battle of the Bands</a></li>
	      	<!--<li><a>Gallery</a></li>-->
	      </ul>
	    </div>

	  </div>
	</nav>


	<!-- Top section after navbar -->
	<div id="page-header" class="container"> 
		<div class="row">
			<div class="col-md-4 col-md-push-4 col-sm-6 col-sm-push-3 col-xs-12 center-text">
				<h1 class="red title">Phi Mu Alpha Sinfonia</h1>
				<h1 class="black title">Beta Tau Chapter</h1>
				<h1 class="gold title">University of Miami</h1>
			</div>

			<div class="col-md-4 col-md-pull-4 col-sm-3 col-sm-pull-6 col-xs-4 col-xs-offset-2 col-sm-offset-0">
				<img src="/images/Coat-of-Arms.png" id="coat-of-arms" class="img-responsive center-block">
			</div>

			<div class="col-md-4 col-sm-3 col-xs-4 col-xs-offset-0 col-sm-offset-0 center-text">
				<img src="/images/U logo.gif" id="u-logo" class="img-responsive center-block">
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
		
			<div class="col-md-6 center-text">
				<p class="text-muted"><a href="mailto:brotherhood@betataupma.org">Brotherhood@BetaTauPMA.org</a></p>
				<p><a href="/legacy/index.php">Legacy Site</a></p>

				
				@if (Auth::check()) 
				<p>Logged in: {{ Auth::user()->name }} - 
				  <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
				  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
				@else
					<a href="{{ url('/login') }}">Login</a>
				@endif
				
			</div>


			<div class="col-md-6 center-block">
				<img src="/images/Banner-Among-Men-Harmony.jpg" id="among-men-harmony" class="img-responsive center-block">
			</div>
		</div>
				
	</div>



	<!-- Google Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-91329586-1', 'auto');
	  ga('send', 'pageview');
	</script>

</body>
</html>