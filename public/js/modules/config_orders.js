let form = $('#config_form');
let quantityOrders = form.find('input[name="quantityOrders"]');
let timeBegin = form.find('input[name="timebegine"]');
let timeEnd = form.find('input[name="timeend"]');
const FADE = new FadeLoading($('#fade-loading'));

config_orders_read();

$(document).ready(function($) {
	
	// save configuration orders
	form.on('submit', (event) => {
		event.preventDefault();
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
	});


});

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