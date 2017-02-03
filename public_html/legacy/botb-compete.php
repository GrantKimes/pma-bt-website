<?php 
    require "php/config.php";
	$highlightAnchors = array("botb-compete.php");

	function generateCompetitionEmail(){

		return 

		"Hello " . $_REQUEST["fname"] . ", \n\n" . 

		"Thank you for expressing interest in Phi Mu Alpha's Battle of the Bands Competition! This email confirms that we received your information.\n\n" .

        "Make sure that you select an audition slot through this Doodle link:\n\nhttp://doodle.com/poll/qdwc7vt3stespec5\n\n" .

        "Feel free to contact me with any questions you might have at j.pressman1@umiami.edu.\n\n" .

		"Good luck, and see you during live auditions!\n\n" .

		"Jake Pressman\n" .
		"Vice President, Beta Tau chapter of Phi Mu Alpha Sinfonia";
	}

	function displayForm(){
		?>

		<form action="botb-compete.php" method="post">
            <p>Groups with multiple members can provide a single member's information.</p>
            <p>Required inputs are outlined in <span class="color-red">red</span>.</p>
        
			<fieldset>
				<legend>Name</legend>
				<label for='fname' class='required'>First Name:</label>
				<input type='text' name='fname' required='required' class='required' maxlength="20" value=<?php echo(echoIfSet("fname"))?>>

				<label for='lname' class='required'>Last Name:</label>
				<input type='text' name='lname' required='required' class='required' maxlength="20" value=<?php echo(echoIfSet("lname"))?>>
                
                <label for='group-name'>Group Name (if applicable):</label>
				<input type='text' name='group-name' maxlength="30" value=<?php echo(echoIfSet("group-name"))?>>
                
                <label for='group-genre' class='required'>Group Genre:</label>
    			<input type='text' required='required' class='required' name='group-genre' maxlength="30" value=<?php echo(echoIfSet("group-genre"))?>>
			</fieldset>

			<fieldset>
				<legend>Contact Information</legend>
				<label for='email' class='required'>Email Address:</label>
				<input type='email' name='email' required='required' class='required' maxlength="40" value=<?php echo(echoIfSet("email"))?>>

				<label for='phone-number' class='required'>Phone:</label>
				<input type='text' name='phone-number' required='required' class='required' maxlength="15" value=<?php echo(echoIfSet("phone-number"))?>>
                
				<label for='c-number'>C-Number (Optional for UM students):</label>
				<input type='text' name='c-number' maxlength="15" value=<?php echo(echoIfSet("c-number"))?>>
                
				<label for='org-rep'>Organization Representing (if applicable):</label>
				<input type='text' name='org-rep' maxlength="40" value=<?php echo(echoIfSet("org-rep"))?>>
			</fieldset>

            <!-- 
			<label for='shirt-size' class='required'>Shirt Size:</label>
			<select name="shirt-size" required="required" class="required">
			  	<option value="Small">Small</option>
  				<option value="Medium" selected="selected">Medium</option>
  				<option value="Large">Large</option>
  				<option value="XL">Extra Large</option>
			</select>
            -->

			<label for="music-desc" class="required">Brief description of your musical style:</label>
			<textarea name="music-desc" required="requried" class="required" rows="10" cols="30"></textarea>

			<p>You will be contacted by your provided email with a confirmation that your submission was received. Your confirmation email will include a link to a Doodle where you can complete your audition sign up by selecting a time slot with the provided link.</p>

			<button name='submit' type='submit' disabled="disabled">Submit!</button>
		</form>

		<?php
	}

	function displaySuccess(){
		?>

		<p>Your information has been submitted! You should receive a message from us shortly. If you don't receive this message, please send an email to <a href="mailto:brotherhood@betataupma.org">brotherhood@betataupma.org</a> and let us know you didn't receive a confirmation email and invitation to schedule an audition session.</p>

		<?php
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Compete in ElectroPHI | &#934&#924&#913 &#914&#932 | UMiami</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet'>
	<noscript><link rel="stylesheet" href="css/no-script-style.css"></noscript>
</head>
<body>

<div id="master-container">
	<?php require "html-header.php"; ?>

	<div id="content-container">
		<div id="main">
			<h3>Compete in the Battle of the Bands Competition</h3>
            
            <p>To compete in the competition, you just need to give us some information about your group, and attend an audition time slot on October 29th.
            More information can be found <a href="botb-competition.php">here</a>.
            </p>
            
            <br>
            <p>Send an email to <strong>BattleOfTheBands@BetaTauPMA.org</strong> with the following information:
            <ul>
                <li>Your name and each of the members in your group</li>
                <li>Group or band name</li>
                <li>Genre</li>
                <li>Email address</li>
                <li>Organization you are representing (if applicable)</li>
                <li>Brief description of your musical style</li>
            </ul>

            <br>
            <p>You will get a response with details about scheduling an audition.
            Feel free to contact the email above with any general questions about the event.</p>
            
			<?php

                exit();
				require_once("php/form-handler.php");

				$inputNames = array("fname", "lname", "group-name", "group-genre", "phone-number", "email", "c-number", "org-rep", "music-desc");
				$requiredInputNames = array("fname", "lname", "group-genre", "phone-number", "email", "c-number", "music-desc");

				if(!handleForm($inputNames, $requiredInputNames, "restricted/dj-entries.txt")){
					displayForm();
				}

				else{
					displaySuccess();

					$email = $_REQUEST["email"];
					$subject = "Battle of the Bands Confirmation";
					$message = generateCompetitionEmail();

					mail($email, $subject, $message, "From: j.pressman1@umiami.edu");
				}

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
<script type = "text/javascript" src="js/universal-form-handler.js"></script>
<script type = "text/javascript" src="js/nav-animate.js"></script>

</body>
</html>