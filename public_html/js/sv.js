
var errMsg;
var table;
var daysDropdown;

var allOrders = null;

$(document).ready(function() {


	getAllOrders();

	errMsg = $('#error-message');
	errMsg.removeClass('hidden').hide();

	$('#response-modal').on('hidden.bs.modal', function() {
		location.reload();
	});

	submitOrder();
	editOrders();


	updateTimeslotOnDaySelect();
	viewDaySelect();


	var dt_settings = {
		order: [[9, 'desc']],
		//responsive: true,
		columns: [
			{ name: "location" },
			{ name: "recipient_name" },
			{ name: "sender_name" },
			{ name: "sender_email", },
			{ name: "song" },
			{ name: "day" },
			{ name: "timeslot" },
			{ name: "comment" },
			{ name: "edit" },
			{ name: "order_id", visible: false },
		]
	};
	table = $('table.datatable').DataTable(dt_settings);

	$('.toggle').hide();
	$('#showHiddenColumnsButton').on('click', function() {
		console.log( $('table.datatable').find('.toggle').fadeToggle('slow') );

	});


});

function getAllOrders() {
	$.ajax({
		type: 'GET',
		url: '/api/orders',

		success: function(response) {
			console.log(response);
			ordersLoaded();
		},

		error: function(response) {
			console.error(response);
			return; 
		}
	});
}


function submitOrder() {
	$('#submit-button').on('click', function(event) {
		$(this).prop('disabled', true);
		errMsg.hide();

		var form = $('form');

		// If there's an error with the form, don't send AJAX request. 
		var error = validate(form);
		if (error != false ) {
			console.log("Invalid form input");
			showError(error);
			$(this).prop('disabled', false);
			return;
		}

		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: form.serialize(),

			success: function(response) {
				var success = response.success;			
				var order = response.order;
				console.log(order);

				if (success) {
					var text = '<p>' + order.sender_name + ', your order for ' + order.recipient_name + ' was successful!</p>'
						+ '<p>A confirmation email has been sent to ' + order.sender_email + '.</p>'
						+ '<p><strong>Make sure to pay $10 cash or Venmo @JordanCraftPMA.</strong></p>';
					$('#response-modal-text').html(text);

					var options = {};
					$('#response-modal').modal(options);
				}
				else {
					console.log("Error with submitting order");
					showError(response.error);
					$(this).prop('disabled', false);
				}
			},

			error: function(response) {
				console.log("Error with submission:");
				console.log(response);
				showError("Error processing submission, your session may have timed out. Try refreshing the page.");
				$(this).prop('disabled', false);
			}
		});
	});
}

function editOrders() {
	$('table a').on('click', function(event) {
		console.log("Clicked wrench to edit order. Now pop up a modal and populate fields for this order.");
		$('#exampleModal').modal();
		var tr = $(this).closest('tr');
		console.log(tr);
		console.log("In click on wrench, ", table.row(tr).data());
	});

	$('table').on('click', 'tr', function() {
		// var rowData = table.row(this).data();
		// console.log(this);
		// console.log("Row data: ", rowData);
		// var form = $('#edit-form');
		// form.find('input[name=recipient_name]').val(rowData[0]);
		// form.find('input[name=sender_name]').val(rowData[1]);
		// form.find('input[name=sender_email]').val(rowData[2]);
		// form.find('select[name=day]').val(rowData[3].toLowerCase());
		// form.find('select[name=timeslot]').val(rowData[4]);
		// form.find('input[name=location]').val(rowData[5]);
		// form.find('select[name=song_choice]').val(rowData[6]);
		// form.find('textarea[name=comments]').val(rowData[7]);

	});
}

function showError(errorMessage) {
	if (errorMessage == '') {
		errorMessage = 'Error submitting order. Your session may have timed out, try refreshing the page.'
	}
	errMsg.text(errorMessage).show('fast');
}


// Change timeslot dropdown according to which day of week is selected.
function updateTimeslotOnDaySelect() {
	$('select.create[name=day]').change(function() {
		var val = $(this).val();
		var dropdownHtml;

		if (val != '') {
			var currDay = timeslots[val];
			dropdownHtml = '<option value="" selected>-- Select a time on ' + readableDate(val) + ' --</option>';
			for (var i = 0; i < currDay.length; i++) {
				var currSlot = currDay[i];
				var disabledIfFilled = (currSlot.filled) ? 'disabled' : '';
				dropdownHtml += '<option ' + disabledIfFilled + '>' + currSlot.time + '</option>';
			}

		}
		else if (val == '') {
			dropdownHtml = '<option value="" selected>-- Choose a timeslot --</option>' + '<option value="" disabled>Select a day first</option>';
		}

		$('select[name=timeslot]').html(dropdownHtml);
	});
}


// On view page, select timeslot and sort table accordingly.
function viewDaySelect() {
	$('select.view[name=day]').change(function() {
		var day = $(this).val();
		var dropdownHtml;

		if (day != '') {
			var currDay = timeslots[day];
			var dropdownHtml = '<option value="" selected>All times</option>';
			for (var i = 0; i < currDay.length; i++) {
				var currSlot = currDay[i];
				dropdownHtml += '<option value="' + currSlot.time + '">' + currSlot.time + ' (' + currSlot.num_slots_taken + '/' + currSlot.num_slots + ')</option>';
			}
		}
		else if (day == '') {
			dropdownHtml = '<option value="" selected>All times</option>';
		}

		$('select[name=timeslot]').html(dropdownHtml);

		table.column('timeslot:name').search('');
		table.column('day:name').search(day).draw();
		console.log("Searching for " + day);
	});

	$('select.view[name=timeslot]').change(function() {
		var timeslot = $(this).val();
		console.log("searching for " + timeslot);

		table.column('timeslot:name').search(timeslot).draw();
	});
}




// Input is required for each of the input & select fields
// Not required for comment field, which is textarea element
function validate(form) {
	var error = false;
	var inputLength = 200;
	var commentLength = 500;

	form.find('input, select').each(function(index) {
		//console.log($(this).val().length );
		if ($(this).val().length > inputLength) {
			error = 'Inputs cannot be longer than ' + inputLength + ' characters.'
		}
		if ($(this).val() == '') {
			error = 'Please fill out all fields.'
		}
	});

	//console.log(form.find('textarea').first().val());
	//console.log(form.find('textarea').first().val().length);
	if (form.find('textarea').first().val().length > commentLength) {
		error = 'Comment cannot be longer than ' + commentLength + ' characters.'
	}

	return error;
}


function readableDate(shortDate) {
	dates = {
		fri: 'Friday, Feb. 10',
		mon: 'Monday, Feb. 13',
		tue: 'Tuesday, Feb. 14'
	};

	return dates[shortDate];
}

daysDropdown = '<option value="fri">Friday, February 10</option>'
	+ '<option value="mon">Monday, February 13</option>'
	+ '<option value="tue">Tuesday, February 14</option>';
