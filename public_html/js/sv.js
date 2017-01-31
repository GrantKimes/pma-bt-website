
var errMsg;

$(document).ready(function() {

	errMsg = $('#error-message');
	errMsg.removeClass('hidden').hide();


	submitOrder();


	updateTimeslotOnDaySelect();


	$('table.datatable').DataTable();

	$('.toggle').hide();
	$('#showHiddenColumnsButton').on('click', function() {
		console.log( $('table.datatable').find('.toggle').fadeToggle('slow') );

	});


});


function submitOrder() {
	$('#submit-button').on('click', function(event) {
		errMsg.hide();

		var form = $('form');

		if (! validate(form) ) {
			console.log("Invalid form input");
			errMsg.show('fast');
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
				console.log(order.sender_name + ", your order was successful");

				var text = '<p>Your order for ' + order.recipient_name + ' was successful!</p>'
					+ '</p>A confirmation email has been sent to ' + order.sender_email + '.</p>';
				$('#response-modal-text').html(text);

				var options = {};
				$('#response-modal').modal(options);
				console.log("made modal");
			},

			error: function(response) {
				console.log("Error with request");
				console.log(response);
			}
		});
		//$.post('/sv', form);
	});
}


// Change timeslot dropdown according to which day of week is selected.
function updateTimeslotOnDaySelect() {
	$('select[name=day]').change(function() {
		var val = $(this).val();
		var dropdownHtml = '<option value="" selected>Select a time on ' + val + '</option>';
		for (var i = 0; i < timeslots[val].length; i++) {
			dropdownHtml += '<option>' + timeslots[val][i] + '</option>';
		}

		$('select[name=timeslot]').html(dropdownHtml);
	});
}

// Input is required for each of the input & select fields
// Not required for comment field, which is textarea element
function validate(form) {
	var valid = true;

	form.find('input, select').each(function(index) {
		if ($(this).val() == '') {
			valid = false;
		}
	});

	return valid;
}


