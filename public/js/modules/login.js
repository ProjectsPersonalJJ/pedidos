$(document).ready(() => {

    //Login
    let form = $('#formLogin');
    let fade_loading = $('#fade-loading');
    const fade = new FadeLoading(fade_loading); //Class

    function validateFalse(array) {
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name=' + k + '] small ul').append('<li>' + element + '</li>');
            });
        });
    }

    function clearMessage() {
        $('div[name=document] small ul').empty();
        $('div[name=password] small ul').empty();
    }

    form.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
            url: "/",
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            beforeSend: () => {
                fade.fade_loading_open();
            }
        })
            .done(function (data) {
                if (data.validate == true) {
                    if (data.auth) {
                        window.location.href = "/home";
                    } else {
                        fade.fade_loading_close();
                        clearMessage();
                        $.notify({
                            // options
                            message: data.message
                        }, {
                            // settings
                            type: 'danger'
                        });
                    }
                } else {
                    fade.fade_loading_close();
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                fade.fade_loading_close();
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


    //Sign in
    let formSignIn = $('#formSignIn');
    formSignIn.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
            url: "/signin",
            type: 'POST',
            dataType: 'json',
            data: formSignIn.serialize(),
            beforeSend: () => {
                fade.fade_loading_open();
            }
        })
            .done(function (data) {
                if (data.validate == true) {
                    window.location.href = "/";
                    fade.fade_loading_close();
                } else {
                    fade.fade_loading_close();
                    clearMessageSignIn();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                fade.fade_loading_close();
                console.log(data);
            });
    });
    function clearMessageSignIn() {
        $('div[name=document] small ul').empty();
        $('div[name=name] small ul').empty();
        $('div[name=lastName] small ul').empty();
        $('div[name=gender] small ul').empty();
        $('div[name=birthDate] small ul').empty();
        $('div[name=email] small ul').empty();
        $('div[name=password] small ul').empty();
        $('div[name=password_confirmation] small ul').empty();
    }
});