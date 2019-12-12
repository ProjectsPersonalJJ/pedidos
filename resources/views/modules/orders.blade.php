@extends('layout.base')

@include('layout.fade_loading')

@section('content')
        <!--================Form Users =================-->
        <section class="home_gallery_area">
            <div class="container">
                <form class="row form_inputs" method="POST" id="orderForm" novalidate="novalidate">
                    @csrf
                    <div class="col-md-12 text-center">
                        <label class="h1">Order&nbsp;<small id="subtitle"></small></label>
                        <hr>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="suppliers">Supplier:</label>
                        <select class="form-control w-100" id="supplier" name="supplier">
                            <option class="w-100" value="0">select...</option>
                            @foreach($suppliers as $supplier)
                                <option class="w-100" value="{{ $supplier->idsupplier }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label>Total Value:</label>
                        <div>
                            <h2 id="totalValue">$ 0</h2>
                        </div>
                    </div>

                    <div class="form-group col-md-8">
                        <label for="products">Products:</label>
                        <select class="form-control w-100" id="products" name="products">
                              <option class="w-100" value="0">Select...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="quantity">Quantity:</label>
                        <input type="number" min="1" value="1" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                    </div>

                    <div class=" form-group col-md-12 d-flex flex-row-reverse">
                        <button type="reset" class="btn btn-primary"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;clear</button>
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
                                <table id="lineOrders" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>supplier</th>
                                    <th>Quantity</th>
                                    <th>Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Line orders -->
                            </tbody>
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
                        <button type="submit" value="submit" class="btn btn-primary" id="search"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" value="submit" class="btn btn-primary" id="settlement"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;settlement</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-target="#modalConfirm" data-toggle="modal" id="request"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Request</button>
                    </div>
                </div>
            </div>
        </section>

        @include('layout.confirm_modal')

@endsection