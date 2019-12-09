//root
let form = $('#formCreateUser');
let placeTable = $('#usersTable');
let fade_loading = $('#fade-loading');
let title_form = $('#title-form');
let action = 1;
const fade = new FadeLoading(fade_loading); //Class
//Field inputs
/*let name = $('input[id="name"]');
let email = $('input[id="email"]');*/
let submit = form.find('button[type="submit"]');

function validateFalse(array) {
    $.each(array, function (k, v) {
        v.forEach(element => {
            $('div[name=' + k + '] small ul').append('<li>' + element + '</li>');
        });
    });
}
function clearMessageUserForm() {
    $('div[name=document] small ul').empty();
    $('div[name=name] small ul').empty();
    $('div[name=lastName] small ul').empty();
    $('div[name=gender] small ul').empty();
    $('div[name=birthDate] small ul').empty();
    $('div[name=typeUser] small ul').empty();
    $('div[name=email] small ul').empty();
    $('div[name=password] small ul').empty();
    $('div[name=password_confirmation] small ul').empty();
}

$(document).ready(() => {
    // Create user
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
                    actionFormUsers();
                }
            }
        });
    });
    //reset form

    form.on('reset', () => {
        changesButtonSubmit(1);
        title_form.text("");
        $('#typeUser option').removeAttr("selected");
        //$('#typeUser option[value=""]').attr('selected', true);
        action = 1;
        //Errors Fields
        clearMessageUserForm();
        showOrHideElements();
    });
    //  Read Users
    consult_users();
});
// Create User
function actionFormUsers() {
    $.ajax({
        url: "/users" + (action == 1 ? '' : ('/' + submit.data("document"))),
        type: (action == 1 ? 'POST' : 'PUT'),
        dataType: 'json',
        data: form.serialize(),
        beforeSend: () => {
            fade.fade_loading_open();
        }
    }).done((data) => {
        if (data.authorize == false) {
            $.notify({ // Estos objetos se retornaran desde el controlador
                //Options
                message: 'Error: ' + data.message
            }, {
                //Settings
                type: 'danger'
            });
        } else {
            if (data.validate) {
                clearMessageUserForm();
                consult_users();
                $.notify({ // Estos objetos se retornaran desde el controlador
                    //Options
                    message: action == 1 ? "Create user success!!" : "Update user success!!" // estos mensajes se van a sacar de un json o un array asociativo de php
                }, {
                    //Settings
                    type: 'success'
                });
                form[0].reset();
            } else {
                clearMessageUserForm();
                validateFalse(data.errors);
                $.notify({ // Estos objetos se retornaran desde el controlador
                    //Options
                    message: 'Error: ' + action == 1 ? 'create user fail.' : 'update user fail.' // estos mensajes se van a sacar de un json
                }, {
                    //Settings
                    type: 'danger'
                });
            }
        }
    }).fail((error) => {
        $.notify({ // Estos objetos se retornaran desde el controlador
            //Options
            message: 'Error: create user fail.' // estos mensajes se van a sacar de un json
        }, {
            //Settings
            type: 'danger'
        });
    }).always(() => {
        fade.fade_loading_close();
    });
}
//  Read Users
function consult_users() {
    $.ajax({
        url: '/users/show',
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

function showOrHideElements() {
    if (action == 2) {
        $('.hideOrShow').hide();
        $('#cancelEdit').show();
    } else {
        form[0].reset();
        $('.hideOrShow').show();
        $('#cancelEdit').hide();
    }
}
//Edit
function editUser(element) {
    let document = $(element).val();
    let token = $('input[name="_token"]').val();
    form[0].reset();
    $.ajax({
        url: "/users/show",
        headers: {
            "X-CSRF-TOKEN": token
        },
        type: 'GET',
        dataType: 'json',
        data: {
            document: document
        },
        beforeSend: () => {
            fade.fade_loading_open();
        }
    }).done((user) => {
        if (user) {

            title_form.text("(" + user.name + " " + user.last_name + ")");
            $('input[id="name"]').val(user.name);
            $('input[id="lastName"]').val(user.last_name);
            $('input[id="birth"]').val(user.birth);
            //$('input[id="birth"]').val(new Date(user.birth).toISOString().substr(0,10));
            if (user.gender == 'F') {
                $('input[id="femenino"]').prop("checked", true);
            } else {
                $('input[id="masculino"]').prop("checked", true);
            }
            $('input[id="email"]').val(user.email);
            $('#typeUser option[value=' + user.idtype_user + ']').attr("selected", true);
            submit.data("document", user.document);
            changesButtonSubmit(2);
            $('html ,body').animate({
                scrollTop: 0
            }, 700);
            action = 2;
            showOrHideElements();
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
function changeStatusUser(element) {
    // let message = $(element).data('status')?"":"";
    let message = "do you wish change status of the user ?";
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
                    url: '/users/' + element.value,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        document: element.value
                    },
                    beforeSend: () => {
                        fade.fade_loading_open();
                    }
                }).done((data) => {
                    if (data.response) {
                        consult_users();
                        $.notify({
                            //Options
                            message: "successful change of status" // estos mensajes se van a sacar de un json
                        }, {
                            //Settings
                            type: 'success'
                        });
                    } else {
                        $.notify({
                            //Options
                            message: "fail change of status" // estos mensajes se van a sacar de un json
                        }, {
                            //Settings
                            type: 'danger'
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