<?php 

// Pass in $_SESSION["account-type"] for $accountLevel. $neededLevel is the permissions level for a requested page.
function checkPermissions($accountLevel, $neededLevel){

	if($accountLevel >= $neededLevel)
		return true;

	else
		return false;
}

 ?>