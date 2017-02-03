<p>Visit us at the UC Breezeway from 11 AM to 2 PM, weekdays from Wednesday, February 3, to Tuesday, February 9, to order a singing valentine!</p>
<form action="buy-singing-valentines.php" method = "post">
	<label for="recipient_name" class="required">Recipient's name</label>
	<input name="recipient_name" type="text" required = "required" class = "required" maxlength = "32">

	<label for="sender_name" class="required">Sender's name</label>
	<input name = "sender_name" type="text" required = "required" class = "required" maxlength = "32">

	<label for="email" class="required">Sender's email</label>
	<input name = "email" type="email" required = "required" class = "required" maxlength = "64">

	<label for="slot" class="required">Time slot</label>
	<?php 
		require_once "php/sv_handler.php";
		echo sv_generateTimeSlots();
	?>
	<label for='slot' class='help'>Recipient should be at the specified location for the entire time slot.</label>

	<label for="location" class="required">Location</label>
	<input name = "location" type="text" required = "required" class = "required" maxlength = "32">
	<label for='location' class='help'>Recipient's location for the time slot. For classes, include building and class room number.</label>

	<label for="song" class="required">Song</label>
	<select name="song" required = "required">
		<option value="afternoon_delight">Afternoon Delight</option>
		<option value="im_yours">I'm Yours</option>
		<option value="still_of_night">In the Still of the Night</option>
		<option value="longest_time">For the Longest Time</option>
		<option value="lovely">Isn't She Lovely</option>
	</select>

	<label for="comments">Comments</label>
	<textarea name="comments" cols="40" rows="10" maxlength = "255"></textarea>

	<label for="pay_code">Pay code</label>
	<input name = "pay_code" type="password" maxlength = "32">
	<label for='pay_code' class='help'>A brother will enter the code when you pay at the Breezeway.</label>
	<br>
	<!--<button name='pay_code_submit' type='submit' disabled='disabled'>Submit with pay code</button>-->
</form>