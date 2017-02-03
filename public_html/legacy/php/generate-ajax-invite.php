<?php
	
	session_start();
	require "bcrypt.php";

	$bcrypt = new Bcrypt(5);

	// Generates an invite url for display in browser
	echo("www.betataupma.org/create-account.php" . 
		"?sender-fname=" . $_SESSION["fname"] . 
		"&amp;sender-lname=" . $_SESSION["lname"] . 
		"&amp;type=" . $bcrypt->hash($_POST["type"]));

?>