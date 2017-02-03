<?php

require_once "config.php";
$highlightAnchors = array();

function reportError($db){
		?>
		<p class="small-text">An error occured while attempting to connect to the database. Attempt submitting again, and if the issue persists please contact an administrator. We apologize for the inconvenience.</p>
		<p class="small-text">Detailed information on the error MAY be displayed below:</p>
		<p class="small-text">
		<?php
		echo($db->connect_error . "</p>");
	}

try{
	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // For debugging, disable when not needed.

	$stmt = $db->prepare("SELECT email FROM users WHERE email = ?");
	$stmt->execute(array($_REQUEST["email"]));
	$emailMatch = $stmt->fetch(PDO::FETCH_ASSOC);

	// Close connection
	$db = null;

} catch (PDOException $e) {
	echo 'An error occurred. If this issue persists, contact us. We apologize for the inconvenience. Detailed error message is: ' . $e->getMessage();
	die;
}

if(!$emailMatch){
	echo("available");
}

else{
	echo("unavailable");
}

?>