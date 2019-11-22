$(document).ready(() => {
    function validateFalse(array){
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name='+k+'] small ul').append('<li>'+element+'</li>');
            });
        });
    }

    function clearMessage(){
        $('div[name=document] small ul').empty();
        $('div[name=password] small ul').empty();
    }
    //root
    let form = $('#formLogin');

    form.on('submit', (event) => {
        event.preventDefault();
        
        $.ajax({
            url: "/",
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
        })
            .done(function (data) {
                if (data.validate == true) {
                    if (data.auth) {
                        window.location.href = "/home";
                    } else {
                        clearMessage();
                        $.notify({
                            // options
                            message: 'Documento o contraseña incorrecta.'
                        }, {
                            // settings
                            type: 'danger'
                        });
                    }
                } else {
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {

                console.log(data);

                $.notify({
                    // options
                    message: 'No se pudo iniciar sesión'
                }, {
                    // settings
                    type: 'danger'
                });

            });

    });
});