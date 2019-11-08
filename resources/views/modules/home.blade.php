@extends('layout.base')

@section('content')

<!--================Home Area =================-->
<section class="home_gallery_area p_120">
    <div class="container">
        <div class="main_title headShake">
            <h2>Sistema de pedidos</h2>
            <p>Es un sistema que se encarga especificamente de la gestion de los pedidos de alimentación de todos los usuarios del sistema para facilitar al maximo este proceso y veneficiar a todas las personas implicitas en este proceso...</p>
        </div>
    </div>
</section>
<!--================End Home Area =================-->
    
<!--================Day Orders =================-->
<section>
    <div class="container">
        <h2 class="text-center">Day Orders</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Document</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Type User</th>
                            <th>DateTime</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1216727816</td>
                            <td>Juan David</td>
                            <td>Marulanda Panigua</td>
                            <td>Admin</td>
                            <td>09:35:07 AM</td>
                            <td>
                                <button class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;See</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Document</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Type User</th>
                            <th>DateTime</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <hr>
        </div>
    </div>
</section>
<!--================End Day Orders =================-->
<br>
<!--================Products for Suppliers =================-->
<section>
    <div class="container">
        <h2 class="text-center">Products by Suppliers</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Super Buerger Napolitana</td>
                            <td>Edwin Guerra</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <hr>
        </div>
    </div>
</section>
<!--================End Products for Suppliers =================-->

@endsection