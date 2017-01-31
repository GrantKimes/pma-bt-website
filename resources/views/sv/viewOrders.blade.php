@extends('base')

@section('title', 'View SV\'s')
@section('sv_tab', 'active')

@section('additional_includes')
	<!-- Datatables CSS -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
	<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">-->
	  
	<!-- Datatables JS -->
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
	<!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>-->


	<!-- My additional JS -->
	<script type="text/javascript" src="/js/sv.js"></script>
@endsection



@section('content')

<div class="container">
	<div class="row">
		<h1>View orders</h1>
	</div>

	<div class="row">
		<div class="col-md-12">
			<select name="day">
				<option selected >All days</option>
			</select>

			<select name="timeslot">
				<option selected >All times</option>
			</select>

			<button id="showHiddenColumnsButton" class="btn btn-primary" type="button">Toggle hidden columns</button>
		</div>

		<div class="col-md-12">
			<h3>Legend</h3>
			<h4>Song abbreviations</h4>
		</div>

		<div class="col-md-12">
			<table class="datatable display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="toggle">Order ID</th>
						<th>Recipient Name</th>
						<th>Sender Name</th>
						<th class="toggle">Sender Email</th>
						<th>Day</th>
						<th>Timeslot</th>
						<th>Song</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($orders as $order)
					<tr>
						<td class="toggle">{{ $order->id }}</td>
						<td>{{ $order->recipient_name }}</td>
						<td>{{ $order->sender_name }}</td>
						<td class="toggle">{{ $order->sender_email }}</td>
						<td>{{ $order->day }}</td>
						<td>{{ $order->timeslot }}</td>
						<td>{{ $order->song_choice }}</td>
						<td><a href="#"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="col-md-12">
			<p><a>Link to SV singing doodle</a></p>
			<p><a>Link to each of the songs</a></p>
		</div>
	</div>
</div>

@endsection