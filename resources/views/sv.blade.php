@extends('base')

@section('title', 'Singing Valentines')
@section('sv_tab', 'active')


@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<img src="images/PMA U.jpg" class="img-responsive img-rounded">
			<i>Need SV images</i>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h2>Singing Valentines</h2>
			<p>
				Every year on Valentine's Day and the two days preceding it, the brothers of Beta Tau go around campus and serenade people in class. We offer a selection of three or four songs arranged in four-part harmony, and send a group of brothers into a classroom at a scheduled time and serenade the recipient. It can be a romantic gesture, or something to embarrass a friend. We also deliver a rose with each song. Look out for our brothers wearing the Giant Heart Costume!
			</p>
			
			<h4>Purchasing</h4>
			<p>
				One singing valentine costs $5. Come see us in the UC Breezeway at our table to purchase one. You'll need this information:
				<ul>
					<li>Your name and email</li>
					<li>Name of person to deliver to</li>
					<li>Time and place to find them (typically a classroom number and class period time)</li>
					<li>A song choice from our selection</li>
					<li>Any notes or special requests</li>
				</ul>
				<i>The ordering & viewing system will only be accessible to brothers</i>
			</p>
		</div>

		<div class="col-md-4">
			<h2>Song Selection</h2>
			<ul>
				<li><a href="#">Afternoon Delight</a><span class="text-muted"> - Artist</span></li>
				<li><a href="#">In the Still of the Night</a><span class="text-muted"> - Artist</span></li>
				<li><a href="#">I'm Yours</a><span class="text-muted"> - Artist</span></li>
				<li><a href="#">Just the Way You Are</a><span class="text-muted"> - Artist</span></li>
			</ul>
			<p><i>These will each be links to Youtube videos</i></p>
		</div>
	</div>
</div>

@endsection
