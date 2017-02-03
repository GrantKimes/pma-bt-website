<?php 
	require "php/config.php";
	require "php/permissions.php";
	$highlightAnchors = array();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Log | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
</head>
<body>

<div id="master-container">
	<?php require "html-header.php"; ?>

	<div id="content-container">
		<div id="main">
			<h3>Update Log and Current Goals</h3>

			<h4>Priorities for Future Updates:</h4>
			<ul>
				<li>Backend code reorganization. This is my top priority so I can increase my coding efficiency. This would mean writing of generalized code libraries and better directory usage.</li>
				<li>Integrate Meet the Bros page.</li>
				<li>Re-integrate login with useful features. Currently it is discluded because it serves no purpose at the moment, but login system code is complete. Likely to also be partially re-written under backend code reorganization.</li>
				<li>Add a calendar system.</li>
				<li>Add media page.</li>
				<li>Allow greater site flexibility. More forms for dynamic code addition.</li>
			</ul>

			<h4>15 September 2013</h4>
			<ul>
				<li>Edits on home page made to make it a more inviting landing page.</li>
				<li>Added Singing Valentines page.</li>
				<li>Added community service page.</li>
				<li>Removed login widget temporarily, until it has a useful function.</li>
			</ul>

			<h4>10 August 2013:</h4>
			<ul>
				<li>After 20 minutes of inactivity while logged in, if you log back in you should be taken back to the page you tried to go to. This was an error, it should have been happening all along.</li>
				<li>Added error reporting. If you're on the site and something crazy unexpected happens, you can now report it.</li>
				<li>Integrated this lovely thing called a sticky footer that attaches itself to the bottom of the browser no matter the height of the page's content.</li>
				<li>Added sticky footers to all pages with a link to error reporting.</li>
				<li>Added functionality to re-send a verification email if you can't find the first one from the dashboard after login. I had to do some database reconstruction for this since I overlooked some details in retrieving the user's account type but it wasn't too bad.</li>
				<li>Added some functions to the dashboard to liven it up and make it more practical and elegant. But it's still mostly sad and empty.</li>
			</ul>

			<h4>6 August 2013:</h4>
			<ul>
				<li>Invites page: generates an invite for account creation. You have to be logged in to do this. Actives can make invites for probationary, alumni, and active accounts. Alumni can only make invites for actives. Pledges can't do anything. Lawl.</li>
				<li>Account creation page: verifies that a link to the page is valid and then reloads it without the link information so it can't be revisited. Allows account creation for whatever account type the invite link is valid for. The account type is hashed so it's nearly impossible to duplicate one without knowing what words to use. Fun fact: for a probationary account the "Hail, brother!" in the first paragraph doesn't appear.</li>
				<li>Login page/Login widget: For logging in, duh. Login is secure, passwords are hashed, and to prevent any brute force hacks (which is really unlikely anyway) accounts are locked for 2 hours after 5 unsuccessful login attempts.</li>
				<li>Account recovery page: After entering first/last name an account can be recovered by email. Also follows the 5 attempts and lockout system, actually on the same count as login does. I just realized this isn't complete so I gotta finish it... Verification and email sending is complete but I still need to make a change your password page.</li>
				<li>Dynamic nav bar: after login the nav bar changes, and is a php file in itself which is included on each page. Highlighted links for the current page are dynamic and are set with some stuff at the beginning of each page to simplify my life.</li>
				<li>Content on Beta Tau page: Thank you Tucci for this. We could always use more though.</li>
				<li>General cleaning stuff up: there's a TON more to clean up but it'll get there.</li>
				<li>To do: more than you can imagine. But the account system is done, without polish but done. That's a massive piece of the puzzle out of the way. Writing code for a login system is super weird and involves a whole lot of odd syntax and commands, so I'm ecstatic it's so close to out of the way entirely.</li>
			</ul>

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