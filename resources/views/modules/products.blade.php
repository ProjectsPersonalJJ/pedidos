@extends('layout.base')

@include('layout.fade_loading');

@section('content')

	    <section class="home_gallery_area">
	        <div class="container">
	            <form class="row form_inputs" method="post" id="form-products" novalidate="novalidate">
					@csrf
	                <div class="col-md-12 text-center">
	                    <label class="h1">Form Products&nbsp;<small id="title-form"></small></label>
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
	                <div class="col-md-12" id="place_table">

	                </div>
	            </div>
	        </div>
	    </section>

@endsection