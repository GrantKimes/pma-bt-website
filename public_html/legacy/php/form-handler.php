<?php 

require_once "config.php";

// If a form is submitted and the request does not properly handle, echoIfSet will make sure inputs are filled that were previously filled out.
function echoIfSet($key){
		if (!empty($_REQUEST[$key]))
			return "'" . $_REQUEST[$key] . "'";

		else
			return '';
}

// Requires the names of inputs from a form. Grabs all form inputs and puts them into an array. Returns the new array with inputs in it.
function getInputs($inputNames){

	$inputArray = array();

	foreach($inputNames as $inputName){

		array_push($inputArray, $_REQUEST[$inputName]);
	}

	return $inputArray;
}

// Takes an array of values and returns a string with each value separated by a space.
function arrayToString($array){

	$arrayString = "";

	foreach($array as $arrayVal){

		if(isset($arrayVal))
			$arrayString .= "'" . $arrayVal . "' ";

		else
			$arrayString .= "N/S ";
	}

	return $arrayString . "\n";

}

// Appends $appendString to the file at $handleLoc
function appendToFile($handleLoc, $appendString){

	$handle = fopen($handleLoc, "a");
	fwrite($handle, $appendString);
	fclose($handle);
}

// Takes the HTML name attributes of wanted inputs and a file location, and appends them to the end of the file at handleLoc
function appendInputsToFile($inputNames, $handleLoc){

	$inputValArray = getInputs($inputNames);
	$inputString = arrayToString($inputValArray); // Grabs input vals with getInputs and formats them into a string with arrayToString\

	appendToFile($handleLoc, $inputString);
}

// Checks if all required inputs are filled. If they are, returns true. If not, returns false.
function areRequiredInputsFilled($inputNames){

	foreach($inputNames as $inputName){

		if(!isset($_REQUEST[$inputName]))
			return false;
	}

	return true;
}

// Takes an array for the input names and an array for required names. If all required input names are filled, then the form info will be handled and handleForm will return true. Else, will return false.
// Mother function for form-handler.
function handleForm($inputNames, $requiredInputNames, $handleLoc){

	if(areRequiredInputsFilled($requiredInputNames)){

		appendInputsToFile($inputNames, $handleLoc);
		return true;
	}

	else
		return false;
}

 ?>