<?php

	function echoForm(){
		require_once "edit-bro-form.php";
	}


	function accountNumberToType($accountType){

		switch($accountType){

			case 3:
				return "probationary";
			case 4:
				return "alumni";
			case 5:
			case 6:
				return "active";
			default:
				echo("<p>Error in internal code. Your account type could not be converted. Please <a href='report-error.php'>report this error</a>.</p>");
				die;
		}
	}

	// Takes an array with a list of keys (strings). If a $_REQUEST is set for that key, then it is added to a new array to be returned. Can be used for forms with optional inputs.
	function filterElements($elements){

		$filteredElements = array();

		// Loops through each string in the $elements array. If a $_REQUEST[$element] is set, that string is added to the $filteredElements array to be returned.
		foreach($elements as $element){
			if(isset($_REQUEST[$element]))
				$filteredElements[] = $element;
		}

		return $filteredElements;
	}

	function uploadError($code){ 

		echo("<p>An error occured during image upload. Detailed information on the error is displayed below:</p>");

        switch ($code) { 
            case UPLOAD_ERR_INI_SIZE: 
                $message = "<p>The uploaded file exceeds the upload_max_filesize directive in php.ini.</p>"; 
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                $message = "<p>The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.</p>"; 
                break; 
            case UPLOAD_ERR_PARTIAL: 
                $message = "<p>The uploaded file was only partially uploaded.</p>"; 
                break; 
            case UPLOAD_ERR_NO_FILE: 
                $message = "<p>No file was uploaded.</p>"; 
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = "<p>Missing a temporary folder.</p>"; 
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                $message = "<p>Failed to write file to disk.</p>"; 
                break; 
            case UPLOAD_ERR_EXTENSION: 
                $message = "<p>File upload stopped by extension.</p>"; 
                break; 
            default: 
                $message = "<p>Unknown upload error...</p>"; 
                break; 
        } 
        return $message; 
    }  

	function isInputSet($name){

		if (empty($_REQUEST[$name])){
			return false;
		}
		else
			return true;
	}

	function areRequiredInputsSet(){

		// All required inputs for the xml bio.
		$inputNames = array("fname", "lname", "hometown", "major", "grad-date-year", "grad-date-semester", "pledge-class-year", "pledge-class-semester");

		for ($i = 0; $i < count($inputNames); $i++)
		{
			if (!isInputSet($inputNames[$i])){
				if($i > 0)
					echo("One or more inputs were not set when the form was submitted. Make sure all required inputs are set before submitting. " . $inputNames[$i]);

				return false;
			}
		}

		if (!isset($_FILES["img"])){
			echo("An image was not selected before submission.");
			return false;
		}

		return true;
	}

	function isImage($image){
		if (($image["type"] == "image/gif")
			|| ($image["type"] == "image/jpeg")
			|| ($image["file"]["type"] == "image/jpg")
			|| ($image["file"]["type"] == "image/png"))

			{return true;}

		else
			return false;
	}

	// Searches for a brother by short name attribute in bros-list.xml; if fails (no match found), returns false. Otherwise, returns the matched brother node.
	function getBrotherElement($brotherName){

		$doc = simplexml_load_file("xml/bros-list.xml");

		foreach($doc->children() as $brother){

			$brotherAttributes = $brother->attributes();

			if($brotherAttributes["name"] == $brotherName)
				return $brother;
		}

		return null;

	}

	// Handles form input and adds it to the bros list using simpleXML... Dealing with formatting and the like along the way.
	// Note that this function could probably be optimized a ton but simpleXML is really annoying and awkward.
	function xmlHandler($shortName){

		// Load in bros list XML doc
		$brosList = new simpleXMLElement("xml/bros-list.xml", null, true);

		// This array holds all elements possibly necessary to edit or construct a brother.
		$elements = array("fname", "mname", "lname", "hometown", "pledge-class-semester", "pledge-class-year", "major", "minor", "grad-date-semester", "grad-date-year", "curr-position", "past-position");

		// Filters out unset (optional) form inputs.
		$elements = filterElements($elements);
		$brother = getBrotherElement($shortName);

		// Code for existing brother
		if(isset($brother)){

			foreach($elements as $element)
					$brother->{$element} = $_REQUEST[$element];
		}

		else{
			// Add new brother
			$newBrother = $brosList->addChild("brother");

			// For identification purposes
			$newBrother->addAttribute("name", $shortName);

			foreach($elements as $element)
				$brother->addChild($element, $_REQUEST[$element]);

		/*
			$newBrother->addChild("fname", $_REQUEST["fname"]);
			if (!empty($_REQUEST["mname"]))
				$newBrother->addChild("mname", $_REQUEST["mname"]);
			$newBrother->addChild("lname", $_REQUEST["lname"]);

			$newBrother->addChild("hometown", $_REQUEST["hometown"]);
			$newBrother->addChild("pledge-class-semester", ucfirst($_REQUEST["pledge-class-semester"]));
			$newBrother->addChild("pledge-class-year", $_REQUEST["pledge-class-year"]);
			$newBrother->addChild("major", $_REQUEST["major"]);
			if (!empty($_REQUEST["minor"])){
				$newBrother->addChild("minor", $_REQUEST["minor"]);
			}
			$newBrother->addChild("grad-date-semester", ucfirst($_REQUEST["grad-date-semester"]));
			$newBrother->addChild("grad-date-year", $_REQUEST["grad-date-year"]);

			if (!empty($_REQUEST["curr-position"])){
				$newBrother->addChild("curr-position", $_REQUEST["curr-position"]);
				$newBrother->addAttribute("status", "active eboard");
			}
			else
				$newBrother->addAttribute("status", accountNumberToType($_SESSION["accountType"]));

			if (!empty($_REQUEST["past-position"]))
				$newBrother->addChild("past-position", $_REQUEST["past-position"]);
		*/
		}

		$brosList->asXml("xml/bros-list.xml");

		return true;
	}

	function imgHandler($shortName){

		if (($_FILES['img']['error'] == UPLOAD_ERR_OK) && (isImage($_FILES["img"]))){

			str_replace("/", "", $shortName); // For sanitization purposes and preventing malicious file uploads.

			$imgDirLoc = DIR_BRO_IMGS . $shortName . "." . str_replace("image/", "", $_FILES["img"]["type"]);

			if(!move_uploaded_file($_FILES["img"]["tmp_name"], $imgDirLoc)){
				echo ("<p>An error occured after image upload. This error is likely due to a server issue. Try submitting again, or contact an administrator to receive assistance. We apologize for the inconvenience.</p>");
				return false;
			}
			else{
				return true;
			}
		}

		else{
			if (!isImage($_FILES["img"]))
				echo("<p>The submitted file is not an accepted image format. Please use an iamge with a .jpg, .jpeg, .png, or .gif file extension.</p>");
			else if ($_FILES['img']['error'] !== UPLOAD_ERR_OK)
				uploadError($_FILES["img"]["error"]);
			else
				echo ("<p>An error occured after image upload. This error is likely due to a server issue. Try submitting again, or contact an administrator to receive assistance. We apologize for the inconvenience.</p>");

			return false;
		}

	}

	if(areRequiredInputsSet()){

		$shortName = strtolower($_REQUEST["fname"] . "_" . strtolower($_REQUEST["lname"]));

		$xmlUploadSuccess = xmlHandler($shortName);
		$imgUploadSuccess = imgHandler($shortName);

		echoForm();

		if ($xmlUploadSuccess && $imgUploadSuccess){
			echo("<p>We've received your information! An administrator should approve your submission soon so your bio can be added to the Meet the Bros page. You will be notified if any resubmission will be required.</p>");
		}
		else if ($xmlUploadSuccess){
			echo("<p>We've received your information! However, an error may have occured during the image upload. Please see below for possible issues.</p>");
			echoForm();
		}
		else if ($imgUploadSuccess){
			echo("<p>Your image was uploaded successfully! However, an error occured while processing your information. Please attempt submitting the form again, or contact an administrator for help.</p>");
			echoForm();
		}
		else{
			echo("<p>Some errors occured. See below for details.</p>");
			echoForm();
		}
	}

	elseif(isset($_SESSION["email"]) && $_SESSION["accountType"] >= 3){
		echoForm();
	}

	elseif(isset($_SESSION["email"]) && $_SESSION["accountType"] < 3)
		echo("<p>Validate your account to use this feature.</p>");

	else
		echo("<p>You must be logged in to use this feature.</p>")

?>