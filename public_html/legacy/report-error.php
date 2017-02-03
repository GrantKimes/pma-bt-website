<?php 
	require "php/config.php";
	$highlightAnchors = array();

	function showErrorForm(){
		?>
		<form action="report-error.php">
			<textarea name="error-report" rows="10">Try to include information about the page the error was found on, and any important details about the error, here. If the error is a display error (relates to how content appears in your browser), please indicate what web browser you are using. Including more information will make error finding and fixing easier!</textarea>
			<button name='submit' type='submit'>Report this Error</button>
		</form>
		<?php
	}

	// Shows error form with an intro from yourself.
	function showErrorIntro(){
		?>
		<p>Hey there!</p>
		<p>This is Austin Clifton, Beta Tau's Webmaster. If you've been experiencing any issues with Beta Tau's website, I'd first like to apologize, and secondly like to thank you for taking the time to report the issue!</p>
		<p>This site is one of my first web development projects, and it's been a huge, long, non-stop project. I try to keep my code clean, but it can get a bit messy at times. I debug as much as I can, but some things are bound to get past me.</p>
		<p>That said, I hope any issues with our site haven't been terribly, fatally, disgustingly unacceptable. Report an error, and I'll eventually find it and make sure it gets fixed!</p>
		<?php
		showErrorForm();
	}

	function showReportFail(){
		?>
		<p>An error occurred while writing your error report to the server. Since you're already using the error report form, I can't tell you to report this error, right? Try submitting again, and if the problem persists, <a href="contact-us.php">contact us</a> with the error and we'll make sure it gets logged. Sorry 'bout that!</p>
		<?php
		showErrorForm();
	}

	function handleErrorReport(){

		$doc = simplexml_load_file("xml/reported-errors.xml");
		$doc->addChild("error", $_REQUEST["error-report"]);
		$success = $doc->asXML("xml/reported-errors.xml");

		if($success)
			echo("<p>Your error report has been successfully submitted! Thank you!</p>");
		else
			showReportFail();
	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Report an Error | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
</head>
<body>

<div id="master-container">
	<?php require "html-header.php"; ?>

	<div id="content-container">
		<div id="main">
			<h3>Report an Error</h3>

			<?php 

				if (isset($_REQUEST["error-report"]))
					handleErrorReport();

				else
					showErrorIntro();
			 ?>

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
<script type = "text/javascript" src="js/report-error-handler.js"></script>

</body>
</html>