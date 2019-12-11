let formPermissions = $('#formUpdatePermissions');
//let loading = $('#fade-loading');
//const fade = new FadeLoading(loading); //Class
let submitPermissions = formPermissions.find('button[type="submit"]');

$(document).ready(function () {    
    formPermissions.on('submit', (event) => {
        event.preventDefault();
        let token = $('input[name="_token"]').val();
        $.ajax({
            url: "/permissions",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": token
            },
            dataType: 'json',
            data: formPermissions.serialize(),
            beforeSend: () => {
                fade.fade_loading_open();
            }
        }).done((data) => {
            //printPermissions(data);
        }).always(() => {
            fade.fade_loading_close();
        });
    });
});

function getPermissions(element) {
    let token = $('input[name="_token"]').val();
    $.ajax({
        url: "/permissions",
        type: 'GET',
        headers: {
            "X-CSRF-TOKEN": token
        },
        dataType: 'json',
        data: { document: $(element).val() },
        beforeSend: () => {
            fade.fade_loading_open();
        }
    }).done((data) => {
        printPermissions(data);
    }).always(() => {
        fade.fade_loading_close();
    });
}

function cleanForm(){
    formPermissions[0].reset();
}

function printPermissions(data) {
    $('#modalPermissions').modal('show');    
    cleanForm();
    $.each(data.response, function (index1, value1) {
        index1 = index1.replace(" ", "", "gi");
        if (value1.options.length == $('#' + index1 + ' input').length) {
            $('#' + index1 + 'All').prop('checked', true);
            $('#' + index1 + ' input').prop('checked', true);
        } else {
            $.each(value1.options, function (index2, value2) {
                if (value2 == 1) {
                    $('#' + index1 + 'Create').prop('checked', true);
                } else if (value2 == 2) {
                    $('#' + index1 + 'Read').prop('checked', true);
                } else if (value2 == 3) {
                    $('#' + index1 + 'Update').prop('checked', true);
                } else if (value2 == 4) {
                    $('#' + index1 + 'Delete').prop('checked', true);
                } else if (value2 == 5) {
                    $('#dayOrders').prop('checked', true);
                } else if (value2 == 6) {
                    $('#productsBySuppliers').prop('checked', true);
                }

            });
        }

    });
}

function checkBoxAll(elemt) {
    if ($(elemt).prop('checked')) {
        $('#' + $(elemt).val() + ' input').prop('checked', true);
    } else {
        $('#' + $(elemt).val() + ' input').prop('checked', false);
    }
}

function checkBoxRead(elemt, value) {
    if ($(elemt).prop('checked') == false) {
        $('#' + value + ' #' + value + 'Update').prop('checked', false);
        $('#' + value + ' #' + value + 'Delete').prop('checked', false);
    }
}

function checkBoxUpdateOrDelete(elemt, value) {
    if ($(elemt).prop('checked') == true) {
        $('#' + value + ' #' + value + 'Read').prop('checked', true);
    }
}




