let action = 1;// 1= create o 2 = Update
let form = $('#form-products');
let placetable = $('#place_table');
let fade_loding = $('#fade-loading');
let title_form = $('#title-form');
//Field Inputs
let name = $('input[name="nameProduct"]');
let seelectSupplier = $('select[name="supplier"]');
let value = $('input[name="value"]');
let submit = form.find('button[type="submit"]');

$(document).ready(() => {

	//Consult products
	consult_products();

	//Create Products
	form.on('submit', (event) => {
		event.preventDefault();

		actionsProductos();
	});

	// reset form
	form.on('reset', (event) => {
		//Reiniciar los campos del formulario y los botones
		action = 1;
		changesButtonSubmit(action);
		submit.removeData('idproduct');
		title_form.text('');
		messageErrorsClear();
	});

	//is numeric
	value.keypress((event) => {
		if (!$.isNumeric(event.key)) {
			event.preventDefault();
		}
	});

});

//
function actionsProductos() {
	bootbox.confirm({
		message: "You wish to execute this action?",
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
					url: 'http://localhost:8000/products' + (action == 2 ? `/${submit.data('idproduct')}` : ''),
					type: action == 1 ? 'POST' : 'PUT',
					dataType: 'json',
					data: form.serialize(),
					beforeSend: () => {
						//Fade - loadion open
						fade_loading_open();
						messageErrorsClear();
					}
				})
					.done((data) => {
						if (data.authorize == false) {
							$.notify({
								message: data.message
							}, {
								type: "danger"
							});
						} else {
							form[0].reset();
							consult_products();
							$.notify({
								message: "Create product success"
							}, {
								type: "success"
							});
						}
						//Fade - loadion close
					})
					.fail((error) => {

						$.map(error.responseJSON.errors, function (element, index) {
							$('#' + index).next('small').text(element[0]);
						})

						$.notify({
							message: "Create product error"
						}, {
							type: "danger"
						});

					}).always(() => {

						fade_loading_close();

					});

			}
		}
	});

}

function consult_products() {
	$.ajax({
		url: 'http://localhost:8000/products/show',
		type: 'GET',
		dataType: 'json'
	})
		.done(function (data) {
			placetable.html(data);

			$("#tabla").DataTable({
				'scrollX': true
			});
		})
		.fail(function () {
			console.log("error");
		});

}

function editProduct(element) {
	let idproduct = element.value;
	let token = $('input[name="_token"]').val();
	$.ajax({
		url: '/products/show',
		headers: { 'X-CSRF-TOKEN': token },
		type: 'GET',
		dataType: 'json',
		data: {
			idproduct: idproduct
		},
		beforeSend: () => {
			fade_loading_open();
		}
	})
		.done(function (product) {

			if (product) {
				form[0].reset();
				action = 2;
				title_form.text(`(${product.name})`);
				name.val(product.name);
				seelectSupplier.find(`option[value="${product.idsupplier}"]`).prop('selected', true);
				value.val(product.value);
				submit.data('idproduct', product.idproduct);
				changesButtonSubmit(action);
				$('body, html').animate({
					'scrollTop': 0
				}, 700);
			}

		})
		.fail(function () {

			console.log("error");

		}).always(() => {

			fade_loading_close();

		});

}

//Change button submit 1=Create 2= Update
function changesButtonSubmit(action = 0) {
	switch (action) {
		case 1:
			//
			submit.removeClass("btn-warning");
			submit.addClass("btn-primary");
			submit.html("<i class=\"fa fa-plus-square-o\" aria-hidden=\"true\"></i>&nbsp;Create");
			break;
		case 2:
			//
			submit.removeClass("btn-primary");
			submit.addClass("btn-warning");
			submit.html("<i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>&nbsp;Update");
			break;
	}
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
					url: 'http://localhost:8000/products/' + element.value,
					headers: { 'X-CSRF-TOKEN': token },
					type: 'DELETE',
					dataType: 'json',
					data: { idproduct: element.value },
					beforeSend: () => {
						fade_loading_open();
					}
				})
					.done(function () {

						consult_products();
						$.notify({
							message: 'Change status success!!'
						}, {
							type: 'success'
						});

					})
					.fail(function () {

						$.notify({
							message: 'Change status Error!!'
						}, {
							type: 'danger'
						});

					}).always(() => {

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

function messageErrorsClear() {
	name.next('small').text('');
	seelectSupplier.next('small').text('');
	value.next('small').text('');
}