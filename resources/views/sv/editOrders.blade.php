@extends('base')

@section('title', 'View SV\'s')
@section('sv_view_tab', 'active')

@section('additional_includes')
	<!-- Datatables CSS -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
	<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">

	<!-- Datatables JS -->
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
	<!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>-->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>


	<!-- My additional JS -->
	<script type="text/javascript" src="/js/sv.js"></script>
@endsection



@section('content')

<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class=" panel-title">View Orders</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-3 col-xs-6">
			    	<select name="day" class="view form-control">
							<option value="" selected>All days</option>
							<option value="fri">Friday, February 10</option>
							<option value="mon">Monday, February 13</option>
							<option value="tue">Tuesday, February 14</option>
			    	</select>
		    	</div>

					<div class="col-md-3 col-xs-6">
						<select name="timeslot" class="view form-control">
							<option selected >All times</option>
							{{-- Gets filled in by by JS when a day is selected --}}
						</select>
					</div>

					{{-- <button id="showHiddenColumnsButton" class="btn btn-primary btn-sm" type="button">Toggle hidden columns</button> --}}

				</div>
			</div>
		</div>

	</div>
</div>



	{{--<div class="col-md-12">--}}
		<table class="datatable display responsive" cellspacing="0" width="100%">
			<thead>
				<tr>
					{{-- <th></th> --}}
					<th>Location</th>
					<th>Recipient Name</th>
					<th>Sender Name</th>
					<th>Sender Email</th>
					<th>Song</th>
					<th>Day</th>
					<th>Timeslot</th>
					<th>Comment</th>
					<th>Edit</th>
					<th>Order ID</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($orders as $order)
				<tr>
					{{-- <td><i class="fa fa-wrench" aria-hidden="true" id="{{ $order->id }}"></i></td> --}}
					<td>{{ $order->location }}</td>
					<td>{{ $order->recipient_name }}</td>
					<td>{{ $order->sender_name }}</td>
					<td>{{ $order->sender_email }}</td>
					<td>{{ $order->song_choice }}</td>
					<td>{{ $order->day }}</td>
					<td>{{ $order->timeslot }}</td>
					<td>{{ $order->comment }}</td>
					<td><a class="link-button"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
					<td>{{ $order->id }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	{{--</div>--}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form id="edit-form" method="POST" action="/sv_edit" class="form-horizontal">
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
						    	<input name="sender_name" type="text" class="form-control" placeholder="Your name (will remain anonymous)">
						    </div>
						  </div>

						  <div class="form-group">
						    <label for="sender_email" class="col-md-3 control-label">Sender's email address</label>
						    <div class="col-md-6">
							    <input name="sender_email" type="text" class="form-control" placeholder="Your email (for receipt)">
						    </div>
						  </div>

						  <div class="form-group">
						    <label for="day" class="col-md-3 control-label">Day</label>
						    <div class="col-md-6">
						    	<select name="day" class="create form-control">
										<option value="" selected>-- Choose a day --</option>
										<option value="fri">Friday, February 10</option>
										<option value="mon">Monday, February 13</option>
										<option value="tue">Tuesday, February 14</option>
						    	</select>
						    </div>
						  </div>


							{{-- Pass timeslots to javascript variable. Accessed through $timeslots['fri'][0]['day_of_week'] --}}
							<script type="text/javascript">
								var timeslots = {};
								@foreach ($timeslots as $day)
									timeslots.{{ $day[0]['day_of_week'] }} = [];
									@foreach ($day as $curr)
										timeslots.{{ $curr['day_of_week'] }}.push({ 
											time: '{{ $curr['class_time'] }}', 
											filled: {{ $curr['filled'] }} 
										});
									@endforeach
								@endforeach
							</script>

						  <div class="form-group">
						    <label for="timeslot" class="col-md-3 control-label">Time slot</label>
						    <div class="col-md-6">
						    	<select name="timeslot" class="create form-control">
										<option value="" selected="">-- Choose a timeslot --</option>
										<option value="" disabled>Select a day first</option>

										{{--
										@foreach ($timeslots as $day)
											@foreach ($day as $curr)
												<option>{{ $curr['day_of_week'] }} > {{ $curr['class_time'] }}</option>
											@endforeach
										@endforeach
									  --}}

						    	</select>
						    </div>
						  </div>

						  <div class="form-group">
								<label for="location" class="col-md-3 control-label">Location</label>
						    <div class="col-md-6">
							    <input name="location" type="text" class="form-control" placeholder="Building & room on campus, ex: Dooly 101">
						    </div>
						  </div>

						  <div class="form-group">
						    <label for="song_choice" class="col-md-3 control-label">Song</label>
						    <div class="col-md-6">
						    	<select name="song_choice" class="form-control" placeholder="Song">
										<option value="" selected>-- Choose a song --</option>
										<option value="Starving">Starving</option>
										<option value="Just the Way You Are">Just the Way You Are</option>
										<option value="Sweet Caroline">Sweet Caroline</option>
										<option value="Afternoon Delight">Afternoon Delight</option>
										<option value="Isn't She Lovely">Isn't She Lovely</option>
										<option value="I'm Yours">I'm Yours</option>
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
							  	Error submitting order. Your session may have timed out, try refreshing the page.
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="container">
	<hr/>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class=" panel-title">Edit Timeslots</h3>
				</div>
				<div class="panel-body">
					<p>
						List all current timeslots in a table here, with option to delete and edit them.
					</p>
					<p>
						Plus button to add a new timeslot, has a date selector to get full date and day of week, class time, num of slots.
					</p>
					<p>
						Button somewhere to start a new year/season. Clears all orders and timeslots. Keeps them archived in db but hidden. 
					</p>
					<p>
						Maybe have a way to send out an email to everyone from the previous year to remind previous buyers. 
					</p>
				</div>
			</div>
		</div>
	</div>


</div>



{{-- Pass timeslots to javascript variable. Accessed through $timeslots['fri'][0]['day_of_week'] --}}
<script type="text/javascript">
	var timeslots = {};
	@foreach ($timeslots as $day)
		timeslots.{{ $day[0]['day_of_week'] }} = [];
		@foreach ($day as $curr)
			timeslots.{{ $curr['day_of_week'] }}.push({ 
				time: '{{ $curr['class_time'] }}', 
				filled: {{ $curr['filled'] }},
				num_slots: {{ $curr['num_slots'] }},
				num_slots_taken: {{ $curr['num_slots_taken'] }} 
			});
		@endforeach
	@endforeach
</script>

@endsection