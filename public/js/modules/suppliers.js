$(document).ready(() => {
//root
let form = $('#formSuppliers');
let placeTable = $('#suppliersTable');

// Create supplier
	form.on('submit', (event) => {
		event.preventDefault();

		$.ajax({
			url: "http://localhost:8000/suppliers",
			type: 'POST',
			dataType: 'json',
			data: form.serialize(),
		})
		.done(function(data) {

			if($.isNumeric(data)){
				form[0].reset();

				$.notify({
				//Options
					message: "Create supplier success!!" // estos mensajes se van a sacar de un json
				},{
				//Settings
					type: 'success'
				});

			}

		})
		.fail(function(data) {

			console.log(data);

			$.notify({
			//Options
				message: "Create supplier error!!" // estos mensajes se van a sacar de un json
			},{
			//Settings
				type: 'danger'
			});

		});
		
	});

//  Read Suppliers
consult_suppliers();

function consult_suppliers() {
	$.ajax({
		url: 'http://localhost:8000/suppliers/show',
		type: 'GET',
		dataType: 'json',
		data: {}
	})
	.done(function(data) {
		placeTable.empty();

		placeTable.html(data);

		placeTable.find('table[id="tabla"]').dataTable({
			"scrollX": true
		});
	})
	.fail(function() {
		console.log("error");
	});
	
}


});

// Changes status
function changeStatusSupplier(element) {
	// let message = $(element).data('status')?"":"";
	let message = "do you wish change status of the supplier ?";
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
	    callback: function (result) {
	        if (result) {
	        	let token = $('input[name="_token"]').val();
	        	$.ajax({
	        		url: 'http://localhost:8000/suppliers/'+ element.value,
	        		headers: {'X-CSRF-TOKEN': token},
	        		type: 'DELETE',
	        		dataType: 'json',
	        		data: {idsupplier: element.value}
	        	})
	        	.done(function(data) {
	        		console.log(data);
	        	})
	        	.fail(function() {
	        		console.log("error");
	        	}); 	
	        }
	    }
	});
}
