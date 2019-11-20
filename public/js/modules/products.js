let action = 1;// 1= create o 2 = Update
let form = $('#form-products');
let placetable = $('#place_table');
let fade_loding = $('#fade-loading');

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

function change_status_product(element) {
	bootbox.confirm({
	    message: "You wish change the status of this product?",
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
	        	let token = $('input[name="_token"]').val();
	        	$.ajax({
	        		url: 'http://localhost:8000/products/'+element.value,
	        		headers: {'X-CSRF-TOKEN': token},
	        		type: 'DELETE',
	        		dataType: 'json',
	        		data: {idproduct: element.value},
	        		beforeSend: () =>{
	        			fade_loading_open();
	        		}
	        	})
	        	.done(function() {

	        		consult_products();
	        		$.notify({
	        			message: 'Change status success!!'
	        		},{
	        			type: 'success'
	        		});

	        	})
	        	.fail(function() {

	        		$.notify({
	        			message: 'Change status Error!!'
	        		},{
	        			type: 'danger'
	        		});

	        	}).always(()=>{

	        		fade_loading_close();

	        	});
	        	
	        }
	    }
	});
}

function fade_loading_open() {
	fade_loding.css('display', 'flex');
}

function fade_loading_close() {
	fade_loding.css('display', 'none');
}