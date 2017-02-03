<?php

// Uses brother's current session first and last name to format his short name for XML searches.
function shortName(){
	return strtolower($_SESSION["fname"] . "_" . $_SESSION["lname"]);
}

// For inserting form values within html. Simply adds single quote marks to the beginning and end of a given string
function formatFormValue($val){

	return "'" . $val . "'";
}

// Searches through a SimpleXML element's children for a specific element. If found, that element's value is returned.
function searchXMLChildren($element, $key){

	foreach($element->children() as $elementChild){
		if($elementChild->getName() == $key)
			return $elementChild;
	}

	return null;
}

// Uses searchXMLChildren and formatFormValue to return a brother's info. $brother should be a SimpleXML brother node from the bros-list.xml file. The $key string should be the xml tag of the element being searched for.
function getBrotherInfo($brother, $key){

	// For cases where user information was submitted but not properly handled
	if (!empty($_REQUEST[$key]))
		return formatFormValue($_REQUEST[$key]);

	// If a brother match was found this will hold a value. Otherwise it will be null.
	elseif(isset($brother)){

		// Searches through children of brother for the proper element by tag name, and returns its value
		return formatFormValue(searchXMLChildren($brother, $key));
	}

	// If none of the above are true form info has not been set.
	return '';
}

// Searches through a simpleXML $brother for the passed in $key (string) and returns html making that radio default if it matches the $radioVal (string, same as the button's value)
function grabRadioDefault($brother, $key, $radioVal){

	// For cases where key was previously set from past submission.
	if (!empty($_REQUEST[$key])){
		if ($radioVal == $_REQUEST[$key])
			return "checked = 'checked'";
	}

	// Grabs brother's previously saved information from XML.
	$savedVal = searchXMLChildren($brother, $key);

	// If the retrieved value equals the radio val, that value should be given a default. If not, simply return an empty string.
	if($savedVal == $radioVal)
		return "checked = 'checked'";

	else
		return '';
}

// Searches through the bros-list XML file with the logged in brother's shortname, e.g. austin_clifton. If info is found, it will be loaded in
$brother = getBrotherElement(shortName());

?>

<p>Whether you're a currently active brother or an alumni from 1937, we'd love to add you to our Meet the Brothers page. Just fill out the form below so we can give your biography the proper information.</p>
<p>Entering your information in the proper format will ensure that sorting brothers in different ways will always work. Follow the examples!</p>
<p><span class='color-red'><b>Red inputs are required</b></span>. An input will fade to gray once filled.</p>

<form action='edit-bro.php' name='bro-adder' method='post' enctype='multipart/form-data'>
	<fieldset>
			<legend>Full Name</legend>
		<div class='input-horizontal'>
			<label for='fname' class='required'>First Name:</label>
			<input type='text' name="fname" readonly="readonly" value= <?php echo("'" . $_SESSION["fname"] . "'")?>>
		</div>
		<div class='input-horizontal'>
			<label for='mname'>Middle Name:</label>
			<input type='text' name='mname' tabindex="1" value= <?php echo(getBrotherInfo($brother, "mname"))?>>
		</div>
		<div class='input-horizontal'>
			<label for='lname' class='required'>Last Name:</label>
			<input type='text' name="lname" readonly="readonly" value= <?php echo("'" . $_SESSION["lname"] . "'")?>>
		</div>
	</fieldset>
	<fieldset>
		<legend>General Information</legend>

		<label for='hometown' class='required'>Hometown:</label>
		<input type='text' name='hometown' required='required' class='required' tabindex="2" value=<?php echo(getBrotherInfo($brother, "hometown"))?>>
		<label for='hometown' class='help'>Formatted as city name, state name. Example: 'Coral Gables, Florida'.</label>

		<div class="semester-and-year">
			<label for="pledge-class-year" class="required">Pledge Class:</label>
			<label for="pledge-class-semester" class="required inline">Fall</label>
			<input type="radio" name="pledge-class-semester" value="Fall" class="required" <?php echo(grabRadioDefault($brother, "pledge-class-semester", "Fall")); ?>>
			<label for="pledge-class-semester" class="required inline">Spring</label>
			<input type="radio" name="pledge-class-semester" value="Spring" class="required" <?php echo(grabRadioDefault($brother, "pledge-class-semester", "Spring")); ?>>

			<label for="pledge-class-year" class="required inline">Year:</label>
			<input type='text' name='pledge-class-year' required='required' tabindex="3" class='required' value=<?php echo(getBrotherInfo($brother, "pledge-class-year"))?>>
			<label for='pledge-class-year' class='help'>Enter the year as "yyyy". Examples: 1995, 2004, 2012</label>
		</div>

		<label for='major' class='required'>Major:</label>
		<input type='text' name='major' tabindex="4" required='required' class='required' value=<?php echo(getBrotherInfo($brother, "major"))?>>
		<label for='major' class='help'>Multiple can be listed.</label>

		<label for='minor'>Minor (if applicable):</label>
		<input type='text' name='minor' tabindex="5" value=<?php echo(getBrotherInfo($brother, "minor"))?>>
		<label for='minor' class='help'>Multiple can be listed.</label>

		<div class="semester-and-year">
			<label for="grad-date-year" class="required">Graduation Date:</label>
			<label for="grad-date-semester" class="required inline">Fall</label>
			<input type="radio" name="grad-date-semester" value="Fall" class="required" <?php echo(grabRadioDefault($brother, "grad-date-semester", "Fall")); ?>>
			<label for="grad-date-semester" class="required inline">Spring</label>
			<input type="radio" name="grad-date-semester" value="Spring" class="required" <?php echo(grabRadioDefault($brother, "grad-date-semester", "Spring")); ?>>

			<label for="grad-date-year" class="required inline">Year:</label>
			<input type='text' name='grad-date-year' tabindex="6" required='required' class='required' value=<?php echo(getBrotherInfo($brother, "grad-date-year"))?>>
			<label for='grad-date-year' class='help'>Enter the year as "yyyy". Examples: 1995, 2004, 2012</label>
		</div>

	</fieldset>
	<fieldset>
		<legend>Executive Board</legend>

		<?php
		// If account type is active or admin active, etc.
		if($_SESSION["accountType"] >= 5){
			?>
			<label for='curr-position'>Current Position:</label>
			<input type='text' name='curr-position' tabindex="7" value=<?php echo(getBrotherInfo($brother, "curr-position"))?>>
			<?php
		}
		?>

		<label for='past-position'>Past Position:</label>
		<input type='text' name = 'past-position' tabindex="8" value=<?php echo(getBrotherInfo($brother, "past-position"))?>>
		<label for='past-position' class='help'>Use most recent, or whichever you'd like to be displayed.</label>

	</fieldset>
	<fieldset>
		<legend>Add a Picture of Yourself!</legend>
		<label for='img' class='required'>Recommended minumum size is 200x200 px. Beyond that, don't worry about the size - we'll do the rest!</label>
		<input type='file' name='img' accept='image/*' tabindex="9" required='required' class='required'>
	</fieldset>
	<p id='form-help'>Make sure all <span class='color-red'>red</span> inputs have been filled out to enable submission!</p>
	<button name='submit' type='submit' disabled='disabled'>Submit!</button>
</form>