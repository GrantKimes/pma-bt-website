@extends('base')

@section('title', 'Singing Valentines')
@section('sv_tab', 'active')


@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<img src="images/sv/Bros-SV.jpg" class="img-responsive img-thumbnail">
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h1 class="title">Singing Valentines</h1>
			<p>
				Each year on Valentine's Day, the brothers of Phi Mu Alpha go around campus delivering Singing Valentines. We send a group of brothers into a classroom at a scheduled time and serenade the person that the sender requested. It can be a romantic gesture to a special someone, or a joke to embarrass a friend. 
			</p>
			<p>
				We offer a selection of five songs to choose from, arranged in four-part vocal harmony. We deliver candy and a red rose to the recipient with each song. We also will have a brother walking around wearing our Giant Heart Costume!
			</p>
			<div class="alert alert-info">
				<p><strong>
					Days: Monday Feb. 11, Wednesday Feb. 13, Thursday Feb. 14
				</strong></p>
			</div>
			
			<div class="media">
			  <div class="media-left media-middle">
		      <img id="snapchat-icon" class="media-object" src="images/icons/Snapchat-color.svg" alt="Snapchat">
			  </div>
			  <div class="media-body media-middle">
			    <p>
					We also have a snapchat filter! Look for it on Valentine's Day during regular class hours in the Dooley, LC, and Cox buildings. 
					</p>
			  </div>
			</div>


			
			<h3 class="title">Purchasing</h3>
			<p>
				Come see us at our table in the <strong>UC Breezeway</strong> to purchase one. We will be <strong>selling on Thursday, Feb. 7, Friday, Feb. 8, and Tuesday, Feb. 12 between 9:00am - 5:00pm.</strong> One singing valentine costs $10, and we accept cash, checks, Venmo, and Paypal. You'll need this information to place an order:
			</p>
			<ul>
				<li>Your name and email</li>
				<li>Name of person to deliver to</li>
				<li>Time and place to find them during a regular class block <span class="text-muted"> - ex: Dooly 101, 9:30am-10:45am</span></li>
				<li>Choice of song from our selection</li>
			</ul>
			<p>
				If you have any questions or requests, you can send an email to <strong>UMiami.PMA@gmail.com</strong> or message our <a href="https://www.facebook.com/betatau1937/" target="_blank">Facebook page</a>.
			</p>
		</div>

		<div class="col-md-4">
			<h3 class="title">Song Selection</h3>
			<ul id="song-list">
				<li>Perfect<span class="text-muted"> - Ed Sheeran</span></li>
				<li>Just the Way You Are<span class="text-muted"> - Bruno Mars</span></li>
				<li>Afternoon Delight<span class="text-muted"> - Starland Vocal Band</span></li>
				<li>Isn't She Lovely<span class="text-muted"> - Stevie Wonder</span></li>
				<li>I'm Yours<span class="text-muted"> - Jason Mraz</span></li>
			</ul>
		</div>

		<div class="col-md-6 col-md-offset-3">
			<img src="images/sv/Lovell-serenading-a-dog.jpg" class="img-responsive img-thumbnail">
		</div>

	</div>
</div>

@endsection
