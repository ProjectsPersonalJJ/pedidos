
class Order{

	constructor() {
		this.id = 0;
		this.line_orders = [];
	}

	registrar_order(){

	}

	consultar_order(){

	}

	modificar_order(){

	}

	destroy(){

	}
}

class Line_order{

	constructor(...line_order){
		this.idLineOrder = line_order[0];
		this.idProducto = line_order[1];
		this.quantity = line_order[2];
		this.value = line_order[3];
		this.idSupplier = line_order[4];
	}

}

let order = null;
// Formato de peso colombiano
const FORMATTER_PESO = new Intl.NumberFormat('es-CO', {
       style: 'currency',
       currency: 'COP',
       minimumFractionDigits: 0
    });

let totalValue = $('#totalValue');
let edit = 0;
let position = -1;
let orderForm = $('form#orderForm');
let suppliers = orderForm.find('[name="supplier"]');
let products = orderForm.find('[name="products"]');
let quantity = orderForm.find('input[name="quantity"]');
let fade_loding = $('#fade-loading');
let tittle = $('small#subtitle');
const fade = new FadeLoading(fade_loding); //Class

$(document).ready(() => {

	let table = $('#lineOrders').find('tbody');
	let btnsearch = $("#search");
	let btnsettlement = $("#settlement");
	const confirm = $("#form-confirm-action"); 

	orderForm.on('reset', (event) => {
		products.empty();
		products.html('<option class="w-100" value="0">Select...</option>');
		suppliers.find('option').attr('selected', false);
		tittle.text('');
	});

	confirm.on('submit', function(event) {// pending
		event.preventDefault();
		$.ajax({
			url: '/orders',
			type: 'POST',
			headers: {'X-CSRF-TOKEN': orderForm.find('[name="_token"]').val()},
			dataType: 'json',
			data: {
				order: order,
				user: $(this).find('input[name="password"]').val()
			} ,
			beforeSend: () =>{
				fade.fade_loading_open();
			}
		})
		.done(function(data) {
			console.log("success");
		})
		.fail(function(error) {
			console.log("error");
		})
		.always(function() {
			fade.fade_loading_close();
		});
		
	});

	orderForm.on('submit', (event) => {

		event.preventDefault();
		let product = products.find('option:selected');
		let insertTable = 0;

		if (edit == 0) {
			// Add product in table line order

				if (order == null) {
					order = new Order();
				}

				//Validation exist product into the table line orders 
				order.line_orders.map(function(element, position) {

					if (element.idProducto == product.val()) {
						element.quantity += Number(quantity.val());
						table.find('tr').eq(position).find('td').eq(2).text(element.quantity);
						element.value = element.quantity * product.data('value');
						table.find('tr').eq(position).find('td').eq(3).text(FORMATTER_PESO.format(element.value));
						insertTable = 1;
					}

				});

				// Insert product into the table line orders
				if (insertTable == 0) {
					order.line_orders.push(
						new Line_order(0, product.val(), Number(quantity.val()), (product.data('value') * quantity.val()), suppliers.find('option:selected').val())
					);

					table.append(`<tr>
			                        <td>${product.attr('name')}</td>
			                        <td>${suppliers.find('option:selected').text()}</td>
			                        <td>${quantity.val()}</td>
			                        <td>${FORMATTER_PESO.format(product.data('value') * quantity.val())}</td>
			                        <td>
			                            <button class="btn btn-warning btn-sm" onclick="editLineOrder(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
			                            <button class="btn btn-danger btn-sm" onclick="deleteLineOrder(this)"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbsp;Delete</button>
			                        </td>
			                    </tr>`);
				}
		}else{
			//Update Table Line orders

			//Validation exist product into the table line orders 
			order.line_orders.map(function(element, index) {

				if (element.idProducto == product.val()) {
					order.line_orders.splice(position, 1);

					element.quantity += Number(quantity.val());
					element.value = element.quantity * product.data('value');

					table.find('tr').eq(index).find('td').eq(2).text(element.quantity);
					table.find('tr').eq(index).find('td').eq(3).text(FORMATTER_PESO.format(element.value));
					table.find('tr').eq(position).remove();

					insertTable = 1;
				}

			});

			if (insertTable == 0) {

				order.line_orders[position].idProducto = product.val();
				order.line_orders[position].idSupplier = suppliers.find('option:selected').val();
				order.line_orders[position].quantity = Number(quantity.val());
				order.line_orders[position].value = (product.data('value') * quantity.val());
				edit = 0;
				//
				table.find('tr').eq(position).find('td').eq(0).text(product.attr('name'));//Product
				table.find('tr').eq(position).find('td').eq(1).text(suppliers.find('option:selected').text());//Supplier
				table.find('tr').eq(position).find('td').eq(2).text(quantity.val());//Quantity
				table.find('tr').eq(position).find('td').eq(3).text(FORMATTER_PESO.format(product.data('value') * quantity.val()));//value
				//
			}

			position= -1;

		}

		valueTotalOrder(order.line_orders);

		orderForm[0].reset();
	});

	suppliers.change((event) => {
		// consultar productos
		if (suppliers.find('option:selected').val() > 0) {

			readProducts(suppliers.find('option:selected').val());

		}else{
			products.empty();
			products.html('<option class="w-100" value="0">Select...</option>');
		}
		
	});

});

function valueTotalOrder(lineOrders) {
	
	let value = 0;

	lineOrders.map(function(element, position) {
		value += element.value;
	})

	totalValue.text(FORMATTER_PESO.format(value));

}

//Actions line orders
	function deleteLineOrder(element) {
			let message = "do you wish delete this product of you order?";
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

			            let position = -1;
			            $('#lineOrders').find('tbody').children('tr').each(function(index, el) {
			           		if (el == $(element).parent().parent()[0]) {
			           			position = index;
			           			el.remove();
			           		}
			           	});

			            if (position !== -1) {
			           		order.line_orders.splice(position, 1);
			            	valueTotalOrder(order.line_orders);
			            } 
			        }
			    }
			});
	}

	function editLineOrder(element) {

		$('#lineOrders').find('tbody').children('tr').each(function(index, el) {
			if (el == $(element).parent().parent()[0]) {
				position = index;
				orderForm[0].reset();// reset form
				edit = 1;
				// consultar los productos del proveedor.
				suppliers.find(`option[value="${order.line_orders[position].idSupplier}"]`).attr('selected', true);
				readProducts(order.line_orders[position].idSupplier, 1);
				quantity.val(order.line_orders[position].quantity);
				tittle.text('(Edit)');
				//Actualizar el submit--->Pending

			}
		});

	}

	function update_button() {// Pending
		
	}

	function readProducts(idSupplier, select = 0) {
		$.ajax({
			url: 'http://localhost:8000/orders/pullProductsBySupplier',
			headers: {'X-CSRF-TOKEN': orderForm.find('[name="_token"]').val()},
			type: 'POST',
			dataType: 'json',
			data: {idSupplier: idSupplier},
			beforeSend: () =>{
				fade.fade_loading_open();
			}
		})
		.done(function(data) {

			products.empty();
			products.html('<option class="w-100" value="0">Select...</option>');

			$.each(data.products, function(index, product) {
				products.append(`<option class="w-100" data-value="${product.value}" name="${product.name}" value="${product.idproduct}">${product.name} | ${FORMATTER_PESO.format(product.value)}</option>`);
			});

			if (select == 1) {
				products.find(`option[value="${order.line_orders[position].idProducto}"]`).attr('selected', true);
			}

		})
		.fail(function(error) {
			$.notify({
				message: `Error: ${error}`
			}, {
				type: 'danger'
			});
		})
		.always(function() {
			fade.fade_loading_close();
		});
	}


// btnrequest.on('click', (event) => {
// 	let message = "do you wish request this order?";
// 	bootbox.confirm({
// 	    message: message,
// 	    buttons: {
// 	        confirm: {
// 	            label: 'Yes',
// 	            className: 'btn-success'
// 	        },
// 	        cancel: {
// 	            label: 'No',
// 	            className: 'btn-danger'
// 	        }
// 	    },
// 	    callback: (result) => {
// 	        if (result) {
// 	            actionFormSuppliers();
// 	        }
// 	    }
// 	});
// });