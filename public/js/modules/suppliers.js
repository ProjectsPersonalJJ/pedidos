$(document).ready(() => {
//root
let form = $('#formSuppliers');
let tableSuppliers = $('#suppliersTable');



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

consult_suppliers();

function consult_suppliers() {
	$.ajax({
		url: 'http://localhost:8000/suppliers/show',
		type: 'GET',
		dataType: 'json',
		data: {},
	})
	.done(function(data) {
		tableSuppliers.html(data);

		tableSuppliers.dataTable({
			"scrollX": true
		});
	})
	.fail(function() {
		console.log("error");
	});
	
}

});