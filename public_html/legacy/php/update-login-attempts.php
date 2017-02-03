<?php 
	require_once "config.php";

	function getRemainingAttemptsAndLastFail($loginEmail){

		// Converts email string to array for PDO statement.
		$loginEmail = array($loginEmail);

		try{
			$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // For debugging, disable when not needed.

			$stmt = $db->prepare("SELECT failedLoginAttempts, lastFailedLogin FROM users WHERE email = ?");
			$stmt->execute($loginEmail);
			$loginInfo = $stmt->fetch();

			// Close connection.
			$db = null;

			// Gives remaining attempts instead of failure count.
			$loginInfo[0] = 4 - $loginInfo[0];

			// Converts login datetime to a php datetime object.
			$loginInfo[1] = new DateTime($loginInfo[1]);

			// Returns an array with number of remaining login attempts and a date object for the last failed login.
			return $loginInfo;

		} catch (PDOException $e) {
			echo ('An error occurred. If this issue persists, contact us. We apologize for the inconvenience. Detailed error message is: ' . $e->getMessage());

			// Close connection.
			$db = null;
			die();
		}
	}

	// Returns 0 if no time is required before next login attempt, or the time remaining if not 0.
	function timeRemainingUntilNextAttempt($remainingAttempts, $lastAttempt){

		if ($remainingAttempts > 0)
			return 0;

		else{
			$timeUntilAttempt = $lastAttempt;
			$timeUntilAttempt->add(date_interval_create_from_date_string("2 hours"));
			$currTime = new DateTime();

			// If time until the next possible attempt has passed
			if ($timeUntilAttempt < $currTime)
				return 0;
			else
				return $currTime->diff($timeUntilAttempt);
		}
	}

	// successfulLogin is a bool and specifies whether the login attempt was successful or not. Returns remaining attempts or time until next available attempt.
	function updateLoginAttempts($loginEmail, $successfulLogin){

		$loginInfo = getRemainingAttemptsAndLastFail($loginEmail);

		$timeUntilAttempt = timeRemainingUntilNextAttempt($loginInfo[0], $loginInfo[1]);

		if (!($timeUntilAttempt === 0))
			return $timeUntilAttempt->format("%h hours, %i minutes");

		$remainingAttempts = $loginInfo[0];
		$timeUntilAttempt = $loginInfo[1];
		$timeUntilAttempt->add(date_interval_create_from_date_string("2 hours"));

		$currTime = new DateTime();

		if ($timeUntilAttempt < $currTime){
			$resetFails = true;
		}
		else{
			$resetFails = false;
		}

		try{
			$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // For debugging, disable when not needed.

			if ($successfulLogin == "true"){
				$stmt = $db->prepare("UPDATE users SET failedLoginAttempts = ? WHERE email = ?");
				$remainingAttempts = 5;
				$bindParams = array("0", $loginEmail);
				$stmt->execute($bindParams);
			}
			else if ($resetFails){
				$stmt = $db->prepare("UPDATE users SET failedLoginAttempts = ?, lastFailedLogin = ? WHERE email = ?");
				$remainingAttempts = 4;
				$currTime = new DateTime();
				$bindParams = array("1", $currTime->format("Y-m-d H:i:s"), $loginEmail);
				$stmt->execute($bindParams);
			}
			else{
				$stmt = $db->prepare("UPDATE users SET failedLoginAttempts = failedLoginAttempts + 1, lastFailedLogin = ? WHERE email = ?");
				$currTime = new DateTime();
				$bindParams = array($currTime->format("Y-m-d H:i:s"), $loginEmail);
				$stmt->execute($bindParams);
			}

			// Close connection.
			$db = null;

			return $remainingAttempts;

		} catch (PDOException $e) {
			echo 'An error occurred. If this issue persists, contact us. We apologize for the inconvenience. Detailed error message is: ' . $e->getMessage();

			// Close connection.
			$db = null;
			die;
		}
	}

 ?>