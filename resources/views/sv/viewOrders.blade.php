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
					<th>Location</th>
					<th>Recipient Name</th>
					<th>Sender Name</th>
					<th>Sender Email</th>
					<th>Song</th>
					<th>Day</th>
					<th>Timeslot</th>
					<th>Comment</th>
					{{--<th></th>--}}
					<th>Order ID</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($orders as $order)
				<tr>
					<td>{{ $order->location }}</td>
					<td>{{ $order->recipient_name }}</td>
					<td>{{ $order->sender_name }}</td>
					<td>{{ $order->sender_email }}</td>
					<td>{{ $order->song_choice }}</td>
					<td>{{ $order->day }}</td>
					<td>{{ $order->timeslot }}</td>
					<td>{{ $order->comment }}</td>
					{{-- <td><a href="#"><i class="fa fa-wrench" aria-hidden="true"></i></a></td> --}}
					<td>{{ $order->id }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	{{--</div>--}}


<div class="container">
	<hr/>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class=" panel-title">Links</h3>
				</div>
				<div class="panel-body">
					<h6>Doodles</h6>
					<a class="btn btn-sm btn-default btn-vert-space" href="http://doodle.com/poll/nw9xmgyzmamcsugk" target="_blank">Tabling</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="http://doodle.com/poll/8vky5d2wkq2kynra" target="_blank">Soloists</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="http://doodle.com/poll/g6ptiggqfrgvyh8v" target="_blank">Tenor 1</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="http://doodle.com/poll/x9gw4vxq7grqxvz7" target="_blank">Tenor 2</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="http://doodle.com/poll/27s8iwkihpytm5hw" target="_blank">Baritone</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="http://doodle.com/poll/bw7vatdhbhawxmb6" target="_blank">Bass</a>

					<hr>

					<h6>Songs</h6>
					<a class="btn btn-sm btn-default btn-vert-space" href="/songs/Starving.pdf" target="_blank">Starving (D)</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="/songs/Just the Way You Are.pdf" target="_blank">Just the Way You Are (Bb)</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="/songs/Sweet Caroline.pdf" target="_blank">Sweet Caroline (G)</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="/songs/Afternoon Delight.pdf" target="_blank">Afternoon Delight (F)</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="/songs/Isn't She Lovely.pdf" target="_blank">Isn't She Lovely (Bb/Gmin)</a>
					<a class="btn btn-sm btn-default btn-vert-space" href="/songs/I'm Yours.pdf" target="_blank">I'm Yours (B)</a>
					<!--<p>Starving</p>
					<p>Just the Way You Are</p>
					<p>Sweet Caroline</p>
					<p>Afternoon Delight</p>
					<p>Isn't She Lovely</p>
					<p>I'm Yours</p>
					
					<p><a href="http://doodle.com/poll/nw9xmgyzmamcsugk" target="_blank">Doodle for tabling</a></p>
					<p><a href="" target="_blank">Doodle for singing</a></p>
					
					<p><a>Link to each of the songs, and/or just list their starting pitches</a></p>
					-->
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