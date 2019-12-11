
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
	}

}

$(document).ready(() => {

	let orderForm = $('form#orderForm');
	let suppliers = orderForm.find('[name="supplier"]');
	let totalValue = orderForm.find('#totalValue');
	let products = orderForm.find('[name="products"]');
	let quantity = orderForm.find('input[name="quantity"]');
	let reset = orderForm.find('button[type="reset"]');
	let table = $('#lineOrders').find('tbody');
	let fade_loding = $('#fade-loading');
	const fade = new FadeLoading(fade_loding); //Class
	let btnsearch = $("#search");
	let btnsettlement = $("#settlement");
	const confirm = $("#form-confirm-action");
	let order = null;

	// Foirmato de peso colombiano
	const formatterPeso = new Intl.NumberFormat('es-CO', {
	       style: 'currency',
	       currency: 'COP',
	       minimumFractionDigits: 0
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

		let insertTable = 0;

		event.preventDefault();
		if (order == null) {
			order = new Order();
		}

		lineOrder = products.find('option:selected');

		order.line_orders.map(function(element, position) {

			if (element.idProducto == lineOrder.val()) {
				element.quantity += Number(quantity.val());
				table.find('tr').eq(position).find('td').eq(2).text(element.quantity);
				element.value = element.quantity * lineOrder.data('value');
				table.find('tr').eq(position).find('td').eq(3).text(formatterPeso.format(element.value));
				insertTable = 1;
			}

		});

		// console.log(order.line_orders);

		if (insertTable == 0) {
			order.line_orders.push(
				new Line_order(0, lineOrder.val(), Number(quantity.val()), lineOrder.data('value') * quantity.val())
			);

			table.append(`<tr>
	                        <td>${lineOrder.attr('name')}</td>
	                        <td>${suppliers.find('option:selected').text()}</td>
	                        <td>${quantity.val()}</td>
	                        <td>${formatterPeso.format(lineOrder.data('value') * quantity.val())}</td>
	                        <td>
	                            <button class="btn btn-warning btn-sm delete"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
	                            <button class="btn btn-danger btn-sm edit"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbsp;Delete</button>
	                        </td>
	                    </tr>`);
		}

		valueTotalOrder(order.line_orders);

		// orderForm.reset(); -----> Pending
		// onclick="editLineOrder(this)"
		// onclick="deleteLineOrder(this)"

	});

	suppliers.change((event) => {
		// consultar productos
		if (suppliers.find('option:selected').val() > 0) {
			$.ajax({
				url: 'http://localhost:8000/orders/pullProductsBySupplier',
				headers: {'X-CSRF-TOKEN': orderForm.find('[name="_token"]').val()},
				type: 'POST',
				dataType: 'json',
				data: {idSupplier: suppliers.find('option:selected').val()},
				beforeSend: () =>{
					fade.fade_loading_open();
				}
			})
			.done(function(data) {

				products.empty();
				products.html('<option class="w-100" value="0">Select...</option>');

				$.each(data.products, function(index, product) {
					products.append(`<option class="w-100" data-value="${product.value}" name="${product.name}" value="${product.idproduct}">${product.name} | ${formatterPeso.format(product.value)}</option>`);
				});

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
		}else{
			products.empty();
			products.html('<option class="w-100" value="0">Select...</option>');
		}
		
	});

	function valueTotalOrder(lineOrders) {
		
		let value = 0;

		lineOrders.map(function(element, position) {
			value += element.value;
		})

		totalValue.text(formatterPeso.format(value));

	}

	$('button.delete').on('click', (event) => {
		// let position;
		// $('#lineOrders').find('tbody').children('tr').each(function(index, el) {
		// 	if (el == $(element).parent().parent()[0]) {
		// 		position = index;
		// 		break;
		// 	}
		// });
		console.log($(this));
	});

});

//Actions line orders
	function deleteLineOrder(element) {

		let position;
		$('#lineOrders').find('tbody').children('tr').each(function(index, el) {
			if (el == $(element).parent().parent()[0]) {
				position = index;
				break;
			}
		});


	}

	function editLineOrder(element) {
		// body...
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