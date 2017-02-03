<?php

// Portion of nav bar will be the same whether user has active session or not.
$header = <<<HTML
	<header>
		<noscript><p class='small-text'>Your browser is currently JavaScript disabled. Enable it for a better experience!</p></noscript>
		<h4>This website is outdated, navigate back to the new site <a href="/">here</a>.</h4>

		<img id="crest" src="img/pma-crest.png" alt="Phi Mu Alpha Sinfonia Crest">
		<h1>
			<span class="color-red">Phi Mu Alpha Sinfonia</span><br>
			<span class="color-black">Beta Tau Chapter</span><br>
			<span class="color-gold">University of Miami</span>
		</h1>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="about-us.php">About Us</a>
					<ul>
						<li><a href="national-pma.php">National Organization</a></li>
						<li><a href="about-beta-tau.php">The Beta Tau Chapter</a></li>
					</ul>
				</li>
				<!-- <li><a href="meet-bros.php">Meet the Brothers</a></li> -->
				<!-- <li><a href="calendars.php">Calendar of Events</a></li> -->
				<li><a href="community-service.php">Community Service</a></li>
				<li><a href="singing-valentines.php">Singing Valentines</a>
					<ul>
						<li><a href="buy-singing-valentines.php">Purchase Singing Valentines</a></li>
					</ul>
				</li>
				<li><a href="botb-competition.php">Battle of the Bands Competition</a>
					<ul>
						<li><a href="botb-compete.php">Compete in BotB</a></li>
					</ul>
				</li>
				<!--
				<li><a href="services.php">Services</a>
					<ul>
						 <li><a href="booking.php">Booking</a></li>
						<li><a href="community-service.php">Community Service</a></li>
						<li><a href="concerts.php">Concerts</a></li>
						<li><a href="singing-valentines.php">Singing Valentines</a></li>
					</ul>
				</li>
				-->
				<!-- <li><a href="merch.php">Merch</a></li> -->
				<!-- <li><a href="media.php">Media</a></li> -->
HTML;

// If user has session login and contact us is replaced by the dashboard.
if (isset($_SESSION["email"])){
	$header = $header . <<<HTML
				<li><a href="dashboard.php">Dashboard</a>
					<ul>
						<li><a href="create-invite.php">Create an Account Invite</a></li>
						<li><a href="edit-bro.php">Edit Bio Information</a></li>
					</ul>
				</li>
				<li><a href="log-out.php">Log Out</a></li>
			</ul>
		</nav>
HTML;
	
	// If on the home page, a horizontal rule will not be added before the image banner.
	if (!isHomePage($highlightAnchors))
		$header = $header . "<hr>";
	
	$header = $header . "</header>";
}

// Otherwise login and contact us anchors will appear.
else{
	$header = $header . <<<HTML
				<!-- <li><a href="login.php">Log In</a></li> -->
				<li><a href="contact-us.php">Contact Us</a></li>
			</ul>
		</nav>
HTML;

	
	$header = $header . "</header>";
}

	$domHeader = new DOMDocument();
	$domHeader->loadHTML($header); // Loads in the header as a DOMDocument object to be manipulated.
	$headerListItems = $domHeader->getElementsByTagName("li"); // Grabs all list items from the header.

	// Using $highlightAnchors, defined at the top of a page as an array with all links that should have the selected class, loops through each list item, first checking if it is part of the original ul or a nested ul, and checks if its child anchors' hrefs should be given the selected class. If it is, class="selected" is added to that anchor OR the li depending on whether it is part of a nested ul for proper css styling.
	foreach($headerListItems as $listItem){
		$childAnchor = $listItem->firstChild; // will always be the li's child anchor if HTML is properly formatted.
		foreach($highlightAnchors as $hrefToHighlight){
			if($listItem->parentNode->parentNode->nodeName == "li"){ // If li is part of a nested ul
				if($childAnchor->getAttribute("href") == $hrefToHighlight)
					$listItem->setAttribute("class", "selected"); // Gives li selected class for proper formatting as a nested ul li.
			}
			else{
				if($childAnchor->getAttribute("href") == $hrefToHighlight)
					$childAnchor->setAttribute("class", "selected");
			}
		}
	}

	echo($domHeader->saveHTML()); // Displays the edited header with proper selected classes.

 ?>