let form = $('#config_form');
let quantityOrders = form.find('input[name="quantityOrders"]');
let timeBegin = form.find('input[name="timebegine"]');
let timeEnd = form.find('input[name="timeend"]');
let er1 = new RegExp("^([01]?[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$");
const FADE = new FadeLoading($('#fade-loading'));

config_orders_read();

$(document).ready(function($) {

	quantityOrders.keypress(function(event) {
		if (!$.isNumeric(event.key)) {
			event.preventDefault();
		}
	});

	timeBegin.keypress(function(event) {
		validation_time(event);
	});	

	timeEnd.keypress(function(event) {
		validation_time(event);
	});
	// save configuration orders
	form.on('submit', (event) => {
		event.preventDefault();
		
		if (er1.test(timeBegin.val()) && er1.test(timeEnd.val())) {
			clean_messege_errors_fields();
			let message = "Do you wish save this configuration?";
			bootbox.confirm({
			    message: message,
			    buttons: {
			        confirm: {
			            label: 'Yes',
			            className: 'btn-success'
			        },
			        cancel: {
			            label: 'No',
			            className: 'btn-danger'
			        }
			    },
			    callback: (result) => {
			    	if (result) {
			    		$.ajax({
			    			url: 'http://localhost:8000/config_orders/1',
			    			type: 'PUT',
			    			dataType: 'json',
			    			data: form.serialize(),
			    			beforeSend: () =>{
			    				FADE.fade_loading_open();
			    			}
			    		})
			    		.done((data) => {
			    			$.notify({
			    				message: "Save Changes success"
			    			},{
			    				type: "success"
			    			});
			    		})
			    		.fail((error) => {
			    			$.notify({
			    				message: `Error: ${error}`
			    			},{
			    				type: "danger"
			    			});
			    		})
			    		.always(() => {
			    			FADE.fade_loading_close();
			    		});
			    		
			    	}
			    }
			});
		}else{
			// mostrar el campo que esta mal estructurado
			if (!er1.test(timeBegin.val())) {
				timeBegin.next('div').find('small').text("Error in format HH:MM:SS");
			}
			if (!er1.test(timeEnd.val())) {
				timeEnd.next('div').find('small').text("Error in format HH:MM:SS");
			}
		}

	});


});

function clean_messege_errors_fields() {
	quantityOrders.next('div').find('small').text("");
	timeBegin.next('div').find('small').text("");
	timeEnd.next('div').find('small').text("");
}

function validation_time(event) {
	if (!$.isNumeric(event.key) && event.key!==":") {
		event.preventDefault();
	}
}

function config_orders_read() {
	$.ajax({
		url: 'http://localhost:8000/config_orders/show',
		headers: {'X-CSRF-TOKEN': form.find('input[name="_token"]').val()},
		type: 'GET',
		dataType: 'json',
		beforeSend: () =>{
			FADE.fade_loading_open();
		}
	})
	.done(function(data) {
		quantityOrders.val(data.quantity);
		timeBegin.val(data.timeBegin);
		timeEnd.val(data.timeEnd);
	})
	.fail(function(error) {
		console.log(error);
		$.notify({
			message: `Error: ${error}`
		},{
			type: "danger"
		});

	}).always(() => {
		FADE.fade_loading_close();
	});
	
}