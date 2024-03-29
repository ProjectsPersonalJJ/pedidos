//root
let form = $('#formSuppliers');
let placeTable = $('#suppliersTable');
let fade_loading = $('#fade-loading');
let title_form = $('#title-form');
let action = 1;
const fade = new FadeLoading(fade_loading); //Class
//Field inputs
let name = $('input[id="name"]');
let email = $('input[id="email"]');
let submit = form.find('button[type="submit"]');
$(document).ready(() => {
    // Create supplier
    form.on('submit', (event) => {
        event.preventDefault();
        // Action 1= Create 2=Update
        let message = "do you wish execute this action ?";
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
                    actionFormSuppliers();
                }
            }
        });
    });
    //reset form
    form.on('reset', () => {
        changesButtonSubmit(1);
        title_form.text("");
        action = 1;
        //Errors Fields
        name.next('small').text("");
        email.next('small').text("");
    });
    //  Read Suppliers
    consult_suppliers();
});
// Create Supplier
function actionFormSuppliers() {
    $.ajax({
        url: "http://localhost:8000/suppliers" + (action == 1 ? '' : ('/' + submit.data("idsupplier"))),
        type: (action == 1 ? 'POST' : 'PUT'),
        dataType: 'json',
        data: form.serialize(),
        beforeSend: () => {
            fade.fade_loading_open();
        }
    }).done((data) => {
        if ($.isNumeric(data)) {
            form[0].reset();
            consult_suppliers();
            $.notify({ // Estos objetos se retornaran desde el controlador
                //Options
                message: "Create supplier success!!" // estos mensajes se van a sacar de un json o un array asociativo de php
            }, {
                //Settings
                type: 'success'
            });
        }
    }).fail((error) => {
        //Errors Fields
        $.map(error.responseJSON.errors, function(element, index) {
            $('#' + index).next('small').text(element[0]);
        })
        $.notify({ // Estos objetos se retornaran desde el controlador
            //Options
            message: `Error: ${error.responseJSON.message}` // estos mensajes se van a sacar de un json
        }, {
            //Settings
            type: 'danger'
        });
    }).always(() => {
        fade.fade_loading_close();
    });
}
//  Read Suppliers
function consult_suppliers() {
    $.ajax({
        url: 'http://localhost:8000/suppliers/show',
        type: 'GET',
        dataType: 'json',
        data: {}
    }).done((data) => {
        placeTable.empty();
        placeTable.html(data);
        placeTable.find('table[id="tabla"]').dataTable({
            "scrollX": true
        });
    }).fail((error) => {
        errorServer(error);
    });
}
//Edit
function editSupplier(element) {
    let idsupplier = $(element).val();
    let token = $('input[name="_token"]').val();
    form[0].reset();
    $.ajax({
        url: "http://localhost:8000/suppliers/show",
        headers: {
            "X-CSRF-TOKEN": token
        },
        type: 'GET',
        dataType: 'json',
        data: {
            idsupplier: idsupplier
        },
        beforeSend: () => {
            fade.fade_loading_open();
        }
    }).done((supplier) => {
        if (supplier) {
            title_form.text("(" + supplier[0].name + ")");
            name.val(supplier[0].name);
            email.val(supplier[0].email);
            submit.data("idsupplier", supplier[0].idsupplier);
            changesButtonSubmit(2);
            $('html ,body').animate({
                scrollTop: 0
            }, 700);
            action = 2;
        }
    }).fail((error) => {
        errorServer(error);
    }).always(() => {
        fade.fade_loading_close();
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
        callback: (result) => {
            if (result) {
                let token = $('input[name="_token"]').val();
                $.ajax({
                    url: 'http://localhost:8000/suppliers/' + element.value,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        idsupplier: element.value
                    },
                    beforeSend: () => {
                        fade.fade_loading_open();
                    }
                }).done((data) => {
                    if (data.mensaje != null) {
                        consult_suppliers();
                        $.notify({
                            //Options
                            message: "successful change of status" // estos mensajes se van a sacar de un json
                        }, {
                            //Settings
                            type: 'success'
                        });
                    }
                }).fail((error) => {
                    errorServer(error);
                }).always(() => {
                    fade.fade_loading_close();
                });
            }
        }
    });
}

function errorServer(error) {
    $.notify({
        //Options
        message: `Error: ${error}` // estos mensajes se van a sacar de un json
    }, {
        //Settings
        type: 'danger'
    });
}