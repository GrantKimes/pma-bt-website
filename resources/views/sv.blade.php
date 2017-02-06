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
				We offer a selection of six songs to choose from, arranged in four-part vocal harmony. We deliver candy and a red rose to the recipient with each song. We also will have a brother walking around wearing our Giant Heart Costume!
			</p>
			<div class="alert alert-info">
			<p><strong>
				Days: Friday Feb. 10, Monday Feb. 13, Tuesday Feb. 14
			</strong></p>
			</div>
			
			<!--<p>
				<img id="snapchat-icon" src="/images/icons/Snapchat-color.svg" height="24px">
				This year we also have a snapchat filter! Look for it on those days during regular class hours in the Dooley, LC, and Cox buildings. 
			</p>-->

			<div class="media">
			  <div class="media-left media-middle">
		      <img id="snapchat-icon" class="media-object" src="images/icons/Snapchat-color.svg" alt="Snapchat">
			  </div>
			  <div class="media-body media-middle">
			    <p>
					This year we also have a snapchat filter! Look for it on those three days during regular class hours in the Dooley, LC, and Cox buildings. 
					</p>
			  </div>
			</div>


			
			<h3 class="title">Purchasing</h3>
			<p>
				Come see us at our table in the <strong>UC Breezeway</strong> to purchase one. We will be <strong>selling from Tuesday, Feb. 7 - Thursday, Feb. 9 between 9:00am - 5:00pm.</strong> One singing valentine costs $10, and we accept cash, Venmo, and Paypal. You'll need this information to place an order:
			</p>
			<ul>
				<li>Your name and email</li>
				<li>Name of person to deliver to</li>
				<li>Time and place to find them during a regular class block <span class="text-muted"> - ex: Dooly 101, 9:30am-10:45am</span></li>
				<li>Choice of song from our selection</li>
				<li>Any comments or special requests</li>
			</ul>
			<p>
				If you have any questions or requests, you can send an email to <a href="mailto:sv@betataupma.org">SV@BetaTauPMA.org</a> or message our <a href="https://www.facebook.com/betatau1937/" target="_blank">Facebook page</a>.
			</p>
		</div>

		<div class="col-md-4">
			<h3 class="title">Song Selection</h3>
			<ul id="song-list">
				<li><a href="https://www.youtube.com/watch?v=xwjwCFZpdns" target="_blank">Starving</a> <span class="badge">new</span><span class="text-muted"> - Hailee Steinfeld, Grey ft. Zedd</span></li>
				<li><a href="https://www.youtube.com/watch?v=LjhCEhWiKXk" target="_blank">Just the Way You Are</a> <span class="badge">new</span><span class="text-muted"> - Bruno Mars</span></li>
				<li><a href="https://www.youtube.com/watch?v=NsLyI1_R01M" target="_blank">Sweet Caroline</a> <span class="badge">new</span><span class="text-muted"> - Neil Diamond</span></li>
				<li><a href="https://youtu.be/b1W5vwhLcsw?t=1m40s" target="_blank">Afternoon Delight</a><span class="text-muted"> - Starland Vocal Band</span></li>
				<li><a href="https://youtu.be/IVvkjuEAwgU?t=3s" target="_blank">Isn't She Lovely</a><span class="text-muted"> - Stevie Wonder</span></li>
				<li><a href="https://www.youtube.com/watch?v=EkHTsc9PU2A" target="_blank">I'm Yours</a><span class="text-muted"> - Jason Mraz</span></li>
			</ul>
		</div>

		<div class="col-md-6 col-md-offset-3">
			<img src="images/sv/Lovell-serenading-a-dog.jpg" class="img-responsive img-thumbnail">
		</div>

	</div>
</div>

@endsection
