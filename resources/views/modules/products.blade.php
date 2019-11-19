@extends('layout.base')


@section('content')

	    <section class="home_gallery_area">
	        <div class="container">
	            <form class="row form_inputs" method="post" id="form-products" novalidate="novalidate">
					@csrf
	                <div class="col-md-12 text-center">
	                    <label class="h1">Form Products</label>
	                    <hr>
	                </div>

	                <div class="form-group col-md-6">
	                    <label for="name">Name product:</label>
	                    <input type="text" class="form-control" id="nameProduct" name="nameProduct" placeholder="Name product">
	                </div>
	                <div class="form-group col-md-6">
	                    <label>Supplier:</label>
	                    <select class="form-control w-100" id="suppliers" name="supplier">
	                    	<option class="w-100" value="0">Select...</option>
	                    	@foreach($suppliers as $supplier)
								<option class="w-100" value="{{$supplier->idsupplier}}">{{ $supplier->name }}</option>
	                    	@endforeach
	                    </select>
	                </div> 

	                <div class=" form-group col-md-6">
	                    <label for="value">value:</label>
	                    <input type="text" class="form-control" id="value" name="value" placeholder="How much this product?">
	                </div> 
	                <div class=" form-group col-md-6">
	                    <label>Actions</label><br>
	                    <button type="submit" value="submit" class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Create</button>
	                    <button class="btn btn-primary" type="reset" value="reset">
	                    &times;&nbsp;Reset</button>
	                    <hr>
	                </div>                 

	                <!-- <div class="form-group col-md-12">
	                    <button type="submit" value="submit" class="btn submit_btn form-control">Iniciar</button>
	                </div> -->
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
	                                <th>ID Prodcut</th>
	                                <th>Name</th>
	                                <th>Supplier</th>
	                                <th>Value</th>
	                                <th>Actions</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                                <td>1</td>
	                                <td>Super Buerger Napolitana</td>
	                                <td>Edwin Guerra</td>
	                                <td>$15.000</td>
	                                <td>
	                                    <button class="btn btn-warning btn-sm disabled"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
	                                    <button class="btn btn-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;Active</button>
	                                </td>
	                            </tr>
	                        </tbody>
	                        <tfoot>
	                            <tr>
	                                <th>ID Prodcut</th>
	                                <th>Name</th>
	                                <th>Supplier</th>
	                                <th>Value</th>
	                                <th>Actions</th>
	                            </tr>
	                        </tfoot>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </section>

@endsection