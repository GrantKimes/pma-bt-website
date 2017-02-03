<?php 

require_once "config.php";

// most definitely doesn't belong here. But this is already a disorganized mess. Fuck it.
function newSafePDO()
{
	// open a safe PDO connection
	$str = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
	return new PDO($str, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function sv_getTakenSlots()
{
	try
	{
		// open a safe PDO connection
		$db = newSafePDO();
		$query = $db->prepare("SELECT * FROM " . DB_SLOTS_TABLE);
		$query->execute();
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);		// boo scalability

		$taken_slots = array
		(
			"wed" => array(),
			"thurs" => array(),
			"fri" => array()
		);

		foreach($rows as $row)
		{
			if(isset($taken_slots[$row['day']][$row['slot']]))
				$taken_slots[$row['day']][$row['slot']] += 1;

			else
				$taken_slots[$row['day']][$row['slot']] = 1;
		}

		return $taken_slots;
	}

	catch(PDOException $ex)
	{
		if(DEBUG)
		{
			echo "<p>$ex</p>";
			return null;
		}

		else
			return null;

	}
}

function sv_getAllSlots()
{
	$json_str = file_get_contents(DIR_JSON . "sv_slots.json");

	if($json_str == false)
	{
		echo "bad, couldn't find json file.";
	}

	$slots_data = json_decode($json_str, true);

	if($slots_data == null)
	{
		echo "bad, json couldn't be decoded.";
	}

	$available_slots = array
	(
		"wed" => array(),
		"thurs" => array(),
		"fri" => array()
	);

	// dump all originally available slots into an array
	foreach($slots_data as $key => $day_of_slots)
	{
		for($i = 0; $i < count($day_of_slots); $i++)
		{
			$start_time = new DateTime($day_of_slots[$i]['start']);
			$end_time = new DateTime($day_of_slots[$i]['end']);
			$formatted_start_time = $start_time->format("g:i");
			$real_index = $formatted_start_time . " - " . $end_time->format("g:i");
			$available_slots[$key][$i] = $real_index;
		}
	}

	return $available_slots;
}

function sv_getAvailableSlots($slots_data)
{
	$taken_slots = sv_getTakenSlots();	// test me plz

	$available_slots = array
	(
		"wed" => array(),
		"thurs" => array(),
		"fri" => array()
	);

	// dump all originally available slots into an array
	foreach($slots_data as $key => $day_of_slots)
	{
		for($i = 0; $i < count($day_of_slots); $i++)
		{
			$start_time = new DateTime($day_of_slots[$i]['start']);
			$end_time = new DateTime($day_of_slots[$i]['end']);
			$formatted_start_time = $start_time->format("g:i");
			$taken_count;

			if(isset($taken_slots[$key][$formatted_start_time]))
				$taken_count = $taken_slots[$key][$formatted_start_time];

			else
				$taken_count = 0;

			$real_index = $formatted_start_time . " - " . $end_time->format("g:i");
			$available_slots[$key][$real_index] = $day_of_slots[$i]['slots'] - $taken_count;
		}
	}

	return $available_slots;
}

function sv_generateTimeSlots()
{
	$json_str = file_get_contents(DIR_JSON . "sv_slots.json");

	if($json_str == false)
	{
		if(DEBUG)
		{
			echo "<p>json file couldn't be found.</p>";
		}

		else
		{
			echo "<p>A fatal error occurred. This error will probably persist...</p>";		// TODO
			return false;
		}
	}

	else	
	{
		$json = json_decode($json_str, true);

		if($json == null)
		{
			if(DEBUG)
				echo "<p>json data couldn't be decoded.</p>";

			else
			{
				echo "<p>A fatal error occurred. This error will probably persist...</p>";	// TODO
				return false;
			}
		}

		$all_slots = sv_getAvailableSlots($json);
		$nice_days = array
		(
			"wed" => "Wednesday",
			"thurs" => "Thursday",
			"fri" => "Friday"
		);

		$res = '<select name="slot" required = "required">';

		foreach($all_slots as $day => $day_slots)
		{
			$res .= "<optgroup label = '" . $nice_days[$day] . "'>";
			foreach($day_slots as $slot => $num_available)
			{
				if($num_available > 0)
				{
					list($start_time) = sscanf($slot, "%s");
					$option_val = $day . " " . $start_time;
					$res .= "<option value = '$option_val'>$slot</option>";
				}

				else
				{
					list($start_time) = sscanf($slot, "%s");
					$option_val = $day . " " . $start_time;
					$res .= "<option value = '$option_val' disabled = 'disabled'>$slot</option>";
				}
			}

			$res .= "</optgroup>";
		}

		$res .= "</select>";
		return $res;
	}
}

function sv_generateForm()
{
	// generateTimeSlots() is called in this script
	require "singing-valentines-form.php";
}

function sv_storeSubmission()
{
	try
	{
		// open a safe PDO connection
		$db = newSafePDO();
		$query = $db->prepare("INSERT INTO " . DB_SLOTS_TABLE . 
			"(sender_name, recipient_name, email, location, song, day, slot, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

		list($day, $slot) = sscanf($_POST['slot'], "%s %s");

		$success = $query->execute(array($_POST['sender_name'], $_POST['recipient_name'], $_POST['email'],
			$_POST['location'], $_POST['song'], $day, $slot, isset($_POST['comments']) ? stripslashes($_POST['comments']) : null));

		return $success;
	}

	catch(PDOException $ex)
	{
		if(DEBUG)
		{
			echo "<p>$ex</p>";
			return false;
		}

		else
			return false;
	}
}

function sv_handleSubmission()
{
	if(isset($_POST['recipient_name']) && isset($_POST['sender_name']) &&
		isset($_POST['email']) && isset($_POST['slot']) && isset($_POST['location']) &&
		isset($_POST['song']))
	{
		// see if paypal button or pay code button was clicked
		if(isset($_POST['pay_code_submit']))
		{
			if($_POST['pay_code'] == BRO_CODE)
			{
				return sv_storeSubmission();
			}

			else
			{
				echo "<p>Invalid pay code entered.</p>";
				return 'bad_code';
			}
		}
	}

	else
	{
		echo "<p>Necessary inputs were not filled before clicking submit. Make sure all inputs are filled, and try again.</p>";
		return false;
	}
}

function sv_formHandler()
{
	if(!empty($_POST))
	{
		$success = sv_handleSubmission();

		if($success === true)
		{
			// todo: send confirmation email
			echo "<p>Success! Your submission has been received and stored. Thank you for supporting us.</p>";
		}

		else if($success != 'bad_code')
		{
			echo "<p>An error occurred while attempting to store your submission. Try submitting again, " .
				"and if the error persists email us at singing_valentines@betataupma.org.</p>";
		}
	}

	sv_generateForm();
}

function sv_generateAllTimesSelect()
{
	$all_slots = sv_getAllSlots();

	$nice_days = array
	(
		"wed" => "Wednesday",
		"thurs" => "Thursday",
		"fri" => "Friday"
	);

	echo '<select name="slot" required = "required">';

	foreach($all_slots as $day => $day_slots)
	{
		echo "<optgroup label = '" . $nice_days[$day] . "'>";
		foreach($day_slots as $slot)
		{
			list($start_time) = sscanf($slot, "%s");
			$option_val = $day . " " . $start_time;
			echo "<option value = '$option_val'>$slot</option>";
		}

		echo "</optgroup>";
	}

	echo "</select>";
}

function generateSubmissionsTable($slot)
{
	list($day, $time) = sscanf($slot, "%s %s");

	try
	{
		$db = newSafePDO();
		$query = $db->prepare("SELECT * FROM " . DB_SLOTS_TABLE . " WHERE day=? AND slot=?");
		$query->execute(array($day, $time));

		echo "<table>";

		// generate table header
		$headers = array("sender name", "recipient name", "sender email", "location", "song", "day", "time slot", "comments");

		echo "<tr>";
		foreach($headers as $header)
			echo "<th>" . $header . "</th>";

		echo "</tr>";

		// definitely could have avoided the fetchAll() here but I'm lazy and didn't figure it out, and this doesn't need scalability
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);

		$nice_days = array
		(
			"wed" => "Wednesday",
			"thurs" => "Thursday",
			"fri" => "Friday"
		);

		$nice_songs = array
		(
			"afternoon_delight" => "Afternoon Delight",
			"im_yours" => "I'm Yours",
			"still_of_night" => "In the Still of the Night",
			"longest_time" => "For the Longest Time",
			"lovely" => "Isn't She Lovely"
		);

		foreach($rows as $row)
		{
			echo "<tr>";
			foreach($row as $type => $col_data)
			{
				if ($type == "day")
				{
					echo "<td>" . $nice_days[$col_data] . "</td>";
				}

				else if ($type == "song")
				{
					echo "<td>" . $nice_songs[$col_data] . "</td>";
				}

				else
				{
					echo "<td>$col_data</td>";
				}
			}

			echo "</tr>";
		}

		echo "</table>";
	}

	catch (PDOException $ex)
	{
		if(DEBUG)
			echo "<p>$ex</p>";

		else
			echo "<p>A database error occurred. If this persists, let Austin know.</p>";
	}

}

function sv_showTakenSlotsHandler()
{
	if(!empty($_POST))
	{
		if(!isset($_SESSION['validated_bro']) || $_SESSION['validated_bro'] != true)
		{
			if($_POST['password'] == BRO_CODE)
			{
				$_SESSION['validated_bro'] = true;
			}

			else
			{	
				echo "<p>invalid password.</p>";
				$_SESSION['validated_bro'] = false;
			}
		}

		if($_SESSION['validated_bro'] == true)
		{
			if(!isset($_POST['slot']))
			{
				echo "<p>Select a slot time and click submit to view that slot's submissions.</p>";
			}

			else
			{
				generateSubmissionsTable($_POST['slot']);
			}
		}
	}
}

?>