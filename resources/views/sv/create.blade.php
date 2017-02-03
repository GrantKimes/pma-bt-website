@extends('base')

@section('title', 'Order SV\'s')
@section('sv_tab', 'active')


@section('content')

<div class="container">
	<div class="row center-text">
		<h3>Singing valentines purchasing form</h3>
	</div>

	<hr>

	@if(count($errors) > 0) 
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="/sv" class="form-horizontal">
				{{ csrf_field() }}

			  <div class="form-group">
			    <label for="recipent_name" class="col-md-3 control-label">Recipient's name</label>
			    <div class="col-md-6">
			    	<input name="recipient_name" type="text" class="form-control"  placeholder="Friend's name">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="sender_name" class="col-md-3 control-label">Sender's name</label>
			    <div class="col-md-6">
			    	<input name="sender_name" type="text" class="form-control" placeholder="Your name">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="sender_email" class="col-md-3 control-label">Sender's email address</label>
			    <div class="col-md-6">
				    <input name="sender_email" type="text" class="form-control" placeholder="Email">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="day" class="col-md-3 control-label">Day</label>
			    <div class="col-md-6">
			    	<select name="day" class="form-control">
							<option value="" selected>Choose a day</option>
							<option value="fri">Friday, February 10</option>
							<option value="mon">Monday, February 13</option>
							<option value="tue">Tuesday, February 14</option>
			    	</select>
			    </div>
			  </div>


				{{-- Pass timeslots to javascript variable --}}
				<script type="text/javascript">
					var timeslots = {};
					@foreach ($timeslots as $day)
						timeslots.{{ $day[0]['day_of_week'] }} = [];
						@foreach ($day as $curr)
							timeslots.{{ $curr['day_of_week'] }}.push('{{ $curr['class_time'] }}');
						@endforeach
					@endforeach
				</script>

			  <div class="form-group">
			    <label for="timeslot" class="col-md-3 control-label">Time slot</label>
			    <div class="col-md-6">
			    	<select name="timeslot" class="form-control">
							<option value="" selected="">Choose a timeslot</option>
							<option value="" disabled>Select a day first</option>

							<!--
							@foreach ($timeslots as $day)
								@foreach ($day as $curr)
									<option>{{ $curr['day_of_week'] }} > {{ $curr['class_time'] }}</option>
								@endforeach
							@endforeach
							-->

			    	</select>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="song_choice" class="col-md-3 control-label">Song</label>
			    <div class="col-md-6">
			    	<select name="song_choice" class="form-control" placeholder="Song">
							<option value="" selected>Choose a song</option>
							<option>Afternoon Delight</option>
							<option>In the Still of the Night</option>
							<option>I'm Yours</option>
			    	</select>
			    </div>
			  </div>


			  <div class="form-group">
			    <label for="comments" class="col-md-3 control-label">Comments</label>
			    <div class="col-md-6">
			    	<textarea name="comments" class="form-control" placeholder="Optional" rows="3"></textarea>
			    </div>
			  </div>
				
				<!--
			  <div id="error-message" class="col-md-6 col-md-offset-3 alert alert-danger hidden">
			  	Please fill out all fields.
       	</div>
       	-->
       	<div class="col-md-6 col-md-offset-3">
				  <div id="error-message" class="alert alert-danger hidden">
				  	Please fill out all fields.
	       	</div>
       	</div>
				
				<div class="col-md-6 col-md-offset-3">
		  		<!--<input value="Submit" type="submit" class="btn btn-block btn-primary">-->
		  		<button id="submit-button" type="button" class="btn btn-block btn-primary">Submit</button>
		  	</div>




				<!-- Notes 
			 	Reset button - <input type="reset">
				Add icons - Font awesome, glyphicons
			 	-->
			</form>
		</div>
	</div>

	<div class="modal fade" id="response-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Success</h4>
	      </div>
	      <div class="modal-body">
	      <p id="response-modal-text">Your order was received! You will recieve an email for confirmation.</p>
	      <!--
	        <form>
	          <div class="form-group">
	            <label for="recipient-name" class="control-label">Recipient:</label>
	            <input type="text" class="form-control" id="recipient-name">
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="control-label">Message:</label>
	            <textarea class="form-control" id="message-text"></textarea>
	          </div>
	        </form>
	        -->
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	        <!--<button type="button" class="btn btn-primary">Send message</button>-->
	      </div>
	    </div>
	  </div>
	</div>

</div>

@endsection