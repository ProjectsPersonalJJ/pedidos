@extends('layout.base')

@section('content')
        <!--================Form Users =================-->
        <section class="home_gallery_area">
            <div class="container">
                <form class="row form_inputs" method="post" id="" novalidate="novalidate">

                    <div class="col-md-12 text-center">
                        <label class="h1">Order</label>
                        <hr>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="suppliers">Supplier:</label>
                        <select class="form-control w-100" id="suppliers">
                            <option class="w-100" value="0">select...</option>
                            @foreach($suppliers as $supplier)
                                <option class="w-100" value="{{ $supplier->idsupplier }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label for="products">Total Value:</label>
                        <div>
                            <h2>$1.000</h2>
                        </div>
                    </div>

                    <div class="form-group col-md-8">
                        <label for="products">Products:</label>
                        <select class="form-control w-100" id="products">
                              <option class="w-100" value="">1</option>
                              <option class="w-100" value="">2</option>
                              <option class="w-100" value="">3</option>
                              <option class="w-100" value="">4</option>
                              <option class="w-100" value="">5</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="quantity">Quantity:</label>
                        <input type="number" min="1" value="1" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                    </div>

                    <div class=" form-group col-md-12 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;clear</button>
                        &nbsp;&nbsp;
                        <button type="submit" value="submit" class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;add</button>
                    </div>                 
                </form>
            </div>
        </section>
<!-- Esto va en otra vista cuando se presione el boton "Search" -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbsp;Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </section>
        
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-auto">
                        <button type="submit" value="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" value="submit" class="btn btn-primary"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;settlement</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-target="#modalConfirm" data-toggle="modal"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Request</button>
                    </div>
                </div>
            </div>
        </section>

        @include('layout.confirm_modal')

@endsection