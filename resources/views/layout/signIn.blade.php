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
                    <div class="feature_item" style="max-width: 80%">
                        <form id="formSignIn" class="row form_inputs" method="post" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 text-center">
                                <label class="h1">Pedidos</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Document:</label>
                                <input type="text" class="form-control" id="document" name="document" placeholder="Your number document">
                                <div class="text-danger" name="document"><small><ul></ul></small></div>
                            </div>
                            <div class="form-group col-md-3">
                                    <label>Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                                    <div class="text-danger" name="name"><small><ul></ul></small></div>
                            </div>
                            <div class="form-group col-md-3">
                                    <label>Last name:</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Your last name">
                                    <div class="text-danger" name="lastName"><small><ul></ul></small></div>
                            </div>
                            <div class="form-group col-md-3">
                                    <label>Gender:</label>
                                        <div class="gender">
                                                <label><input type="radio" name="gender" id="gender" value="0">F</label>
                                                <label><input type="radio" name="gender" id="gender" value="1">M</label>
                                        </div>
                                    <div class="text-danger" name="gender"><small><ul></ul></small></div>
                            </div>
                            <div class="form-group col-md-3">
                                    <label>Birth date:</label>
                                    <input type="date" class="form-control" id="birthDate" name="birthDate" placeholder="Your birth date">
                                    <div class="text-danger" name="birthDate"><small><ul></ul></small></div>
                            </div>
                            <div class="form-group col-md-3">
                                    <label>Email:</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Your email">
                                    <div class="text-danger" name="email"><small><ul></ul></small></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Password:</label>
                                <input type="password" class="form-control" id="pass" name="password" placeholder="Your password">
                                <div class="text-danger" name="password"><small><ul></ul></small></div>
                            </div>
                            <div class="form-group col-md-3">
                                    <label>Confirm password:</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Your password">
                                    <div class="text-danger" name="password_confirmation"><small><ul></ul></small></div>
                                </div>
                            <div class="form-group col-md-12">
                                <button type="submit" value="submit" class="btn submit_btn form-control">Sign in</button>
                            </div>
                        </form>
                        <div style="text-align: right;"><a href="/">Back</a></div>
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
        <!-- Class -->
        <script src="js/class/FadeLoading.js"></script>
        <script src="vendors/bootstrap-notify-master/bootstrap-notify.min.js"></script>
        <script src="js/modules/login.js"></script>
    </body>
</html>