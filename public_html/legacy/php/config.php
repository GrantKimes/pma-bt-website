<?php

	session_start();

	define('DEBUG', false); // Set true if on localhost

	if(DEBUG == true)
	{
	    ini_set('display_errors', 'On');
	    error_reporting(E_ALL);
	}
	else
	{
	    ini_set('display_errors', 'Off');
	    error_reporting(0);
	}

	// MySQL database variables
	// for domain
	define("DB_HOST", "PMABetaTauDB.db.11516594.hostedresource.com");
	define("DB_NAME", "PMABetaTauDB");
	define("DB_USERNAME", "PMABetaTauDB");
	define("DB_PASSWORD", "D3ceptive!");
	define("DB_SLOTS_TABLE", "timeSlots");

	// for localhost
	/*
	define("DB_HOST", "localhost");
	define("DB_NAME", "singingValentines");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "root");
	define("DB_SLOTS_TABLE", "timeSlots");
	*/

	// Directory things.

	define("DIR_BASE", dirname(dirname(__FILE__)) . "/");
	define("DIR_JS", DIR_BASE . "js/");
	define("DIR_XML", DIR_BASE . "xml/");
	define("DIR_IMG", DIR_BASE . "img/");
	define("DIR_JSON", DIR_BASE . "json/");
	define("DIR_BRO_IMGS", DIR_IMG . "brothers/");

	define("BRO_CODE", 'betaTauSV2016');

	if (isset($_SESSION["email"])){

		// If last session activity was over 20 minutes ago, session will be destroyed.
		if (isset($_SESSION["last-activity"]) && (time() - $_SESSION["last-activity"] > 1200)) {
		    session_unset();
		    session_destroy();

		    // Resets new session with redirect. If brother logs back in, he will be taken to the page he was previously using.
		    session_start();
		    $_SESSION["urlRedirect"] = $_SERVER["REQUEST_URI"];
		    
		    redirectTo("login.php");
		}

		$_SESSION["last-activity"] = time();

		if (!isset($_SESSION["created"])){
	    	$_SESSION["created"] = time();
	    	$_SESSION["last-activity"] = time();
	    }

		else if (time() - $_SESSION["created"] > 1200) { // session started more than 30 minutes ago
	    	session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
	  		$_SESSION["created"] = time();  // update creation time
		}
	}

	function redirectTo($urlRedirect){

		unset($_SESSION["urlRedirect"]);

		$urlRedirect = "'" . $urlRedirect . "'";

		?>
		<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
		<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type = "text/javascript">

		$(document).ready(function(){

			window.location.replace(<?php echo($urlRedirect); ?>);

		});

		</script>

		<?php 
			if ($urlRedirect == DIR_BASE . "dashboard.php"){ 
			?>
			<noscript>
				<p>Welcome back, <?php echo($_SESSION["fname"]) ?>! You have been successfully logged in. Click <a href=<?php echo("'" . $urlRedirect . "'"); ?>>here</a> to enter your dashboard.</p>
				<p>Note: your browser does not support JavaScript or JavaScript is currently turned off. To improve your experience, enable JavaScript!</p>
			</noscript>
			<?php
			}
			
			else{
			?>
			<noscript>
				<p>Click <a href=<?php echo("'" . $urlRedirect . "'"); ?>>here</a> to continue.</p>
				<p>Note: your browser does not support JavaScript or JavaScript is currently turned off. To improve your experience, enable JavaScript!</p>
			</noscript>
			<?php
		}
	}

?>