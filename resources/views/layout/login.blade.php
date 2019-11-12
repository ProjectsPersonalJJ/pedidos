<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Pedidos - Login</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/animate-css/animate.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/Layout/login.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="feature_inner d-flex justify-content-center align-items-center">
                    <div class="feature_item">
                        <form class="row form_inputs" method="post" id="" novalidate="novalidate">
                            <div class="col-md-12 text-center">
                                <label class="h1">Pedidos</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>User:</label>
                                <input type="text" class="form-control" id="user" name="user" placeholder="Your number document">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Password:</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Your password">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" value="submit" class="btn submit_btn form-control">Iniciar</button>
                                <div class="text-center text-danger"><small>El usuario o la contraseña es incorrecto.</small></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="vendors/bootstrap-notify-master/bootstrap-notify.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.notify({
                    // options
                    message: 'No se pudo iniciar sesión' 
                },{
                    // settings
                    type: 'danger'
                });
            });
        </script>
    </body>
</html>