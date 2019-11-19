let action = 1;// 1= create o 2 = Update
let form = $('#form-products');
let placetable = $('#place_table');

$(document).ready(function($) {
	
	//Consult products
	consult_products();

	//Create Products
	form.on('submit', (event) => {
		event.preventDefault();
		
		actionsProductos();
	});

	form.on('reset', (event) => {
		//Reiniciar los campos del formulario y los botones
	});
});

//
function actionsProductos() {
	$.ajax({
		url: 'http://localhost:8000/products',
		type: action==1?'POST':'PUT',
		dataType: 'json',
		data: form.serialize(),
		beforeSend: () =>{
			//Fade - loadion open
		}
	})
	.done((data) => {
		form[0].reset();

		$.notify({
			message: "Create product success"
		},{
			type: "success"
		});
		//Fade - loadion close
	})
	.fail(() => {

		$.notify({
			message: "Create product error"
		},{
			type: "danger"
		});

	});
	
}

function consult_products() {
	$.ajax({
		url: 'http://localhost:8000/products/show',
		type: 'GET',
		dataType: 'json'
	})
	.done(function(data) {
		placetable.html(data);

		$("#tabla").DataTable({
			'scrollX': true
		});
	})
	.fail(function() {
		console.log("error");
	});
	
}