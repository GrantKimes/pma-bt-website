<?php
	require_once "php/sv_handler.php";
?>

<head>
	<meta charset="UTF-8">
	<title>Singing Valentines | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/table.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
	<noscript><link rel="stylesheet" href="css/no-script-style.css"></noscript>
</head>

<form action="view-singing-valentines.php" method = "post">
	
	<?php

	sv_showTakenSlotsHandler();

	if(!isset($_SESSION['validated_bro']) || $_SESSION['validated_bro'] != true)
	{
		echo "<p>enter password to view:</p>";
		echo '<input type="password" name="password"><br><br>';
	}

	else
	{
		echo "<p>day/time slot:</p>";
		sv_generateAllTimesSelect();
	}

	?>

	<br><br>
	<input type="submit">
</form>