<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Pedidos</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/animate-css/animate.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/Layout/header.css">
        <link rel="stylesheet" href="css/Layout/footer.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    </head>
    <body>
       <!--================Header Menu Area =================-->
       <header class="header_area">
           <div class="main_menu">
               <nav class="navbar navbar-expand-lg navbar-light">
                   <div class="container box_1620">
                       <!-- Brand and toggle get grouped for better mobile display -->
                       <a class="navbar-brand logo_h" href="home"><img src="img/logo" alt="">Logo</a>
                       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <!-- Collect the nav links, forms, and other content for toggling -->
                       <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                           <ul class="nav navbar-nav menu_nav ml-auto">
                               <li class="nav-item active"><a class="nav-link" href="/home">Home</a></li> 
<!-- acá va lo de camilo -->
                            
                               <li class="nav-item"><a class="nav-link" href="users">Users</a></li> 
                               <li class="nav-item submenu dropdown">
                                   <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orders&nbsp;<i class="fa fa-sort-asc" aria-hidden="true"></i></a>
                                   <ul class="dropdown-menu">
                                       <li class="nav-item"><a class="nav-link" href="orders">Orders</a></li>
                                       <li class="nav-item"><a class="nav-link" href="config_orders">Config Orders</a></li>
                                   </ul>
                               </li>     
                               <li class="nav-item submenu dropdown">
                                   <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products&nbsp;<i class="fa fa-sort-asc" aria-hidden="true"></i></a>
                                   <ul class="dropdown-menu">
                                       <li class="nav-item"><a class="nav-link" href="products">Products</a></li>
                                       <li class="nav-item"><a class="nav-link" href="suppliers">Suppliers</a></li>
                                   </ul>
                               </li> 
                               <li class="nav-item submenu dropdown">
                                   <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acount&nbsp;<i class="fa fa-sort-asc" aria-hidden="true"></i></a>
                                   <ul class="dropdown-menu exit">
                                       <li class="nav-item"><a class="nav-link" href="/logout">Exit</a></li>
                                   </ul>
                               </li>
                               <li class="nav-item">&nbsp;</a></li>  
                               <li class="nav-item">&nbsp;</a></li> 
                           </ul>                        
                       </div> 
                   </div>
               </nav>
           </div>
       </header>
        <!--================Header Menu Area =================-->

        <!--================Home Area =================-->
        @yield('content', 'Default')
        <!--================End Home Area =================-->

        <!--================ start footer Area  =================-->    
        <footer class="footer-area section_gap">
            <div class="container">
                <div class="border_line"></div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-8 col-md-8 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This software is developed by JD Marulanda and JC Muñoz
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    <div class="col-lg-4 col-md-4 footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <!-- <a href="#"><i class="fa fa-behance"></i></a> -->
                    </div>
                </div>
            </div>
        </footer>
        <!--================ End footer Area  =================-->
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then bootbox.js -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Data tablet Bootstrap 4 -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <!-- Bootbox.js -->
        <script src="vendors/bootbox.min.js"></script>
        <script src="vendors/bootbox.locales.min.js"></script>
        <!-- Notify.js -->
        <script src="vendors/bootstrap-notify-master/bootstrap-notify.min.js"></script>
        <!-- Class -->
        <script src="js/class/FadeLoading.js"></script>
        <!-- Main Script -->
        @switch($module)
          @case(1)
            <script src="js/modules/suppliers.js"></script> 
            @break
          @case(2)
            <script type="text/javascript">
              $('#example').DataTable({
                "scrollX":true
              });
            </script>
            @break
          @case(3)
            <!-- Main js Products -->
            <script src="js/modules/products.js"></script>
            @break;
          @case(4)
          <!-- Main js Config Orders -->
            <script src="js/class/FadeLoading.js"></script>
            <script src="js/modules/config_orders.js"></script>
            @break;
        @endswitch
    </body>
</html>
<!-- New color morado claro #8d83ff -->