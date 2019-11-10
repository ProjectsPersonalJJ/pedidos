@extends('layout.base')

@section('content')

        <section class="home_gallery_area">
            <div class="container">
                <form class="row form_inputs" method="POST" id="formSuppliers">
                    @csrf
                    <div class="col-md-12 text-center">
                        <label class="h1">Form Suppliers</label>
                        <hr>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Name Supplier:</label>
                        <input type="text" maxlength="45" class="form-control" name="name" placeholder="Your name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">E-mail:</label>
                        <input type="email" maxlength="45" class="form-control" name="email" placeholder="Your E-mail">
                    </div>
  
                    <div class=" form-group col-md-6">
                        <label>Actions</label><br>
                        <button type="submit" value="submit" class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Create</button>
                        <a class="btn btn-primary" href="#"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</a>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <button type="rest" id="rest" class="btn btn-primary btn-sm"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Clear</button>
                    </div>            
                </form>
            </div>
        </section>
<!-- Esto va en otra vista cuando se presione el boton "Search" -->
        <section id="ReadSuppliers">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table id="suppliersTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name Supplier</th>
                                    <th>E-mail</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm disabled"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
                                        <button class="btn btn-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;Active</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name Supplier</th>
                                    <th>E-mail</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
@endsection