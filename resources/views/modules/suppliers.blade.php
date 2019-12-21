@extends('layout.base')

@include('layout.fade_loading');

@section('content')
@if (in_array(1,$optionsSuppliers))
<section class="home_gallery_area">
    <div class="container">
        <form class="row form_inputs" method="POST" id="formSuppliers">
            @csrf
            <div class="col-md-12 text-center">
                <label class="h1">Form Suppliers&nbsp;<small id="title-form"></small></label>
                <hr>
            </div>

            <div class="form-group col-md-6">
                <label for="name">Name Supplier:</label>
                <input type="text" maxlength="45" class="form-control" id="name" name="name" placeholder="Your name">
                <small class="text-danger"></small>
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" maxlength="45" class="form-control" id="email" name="email" placeholder="Your E-mail">
                <small class="text-danger"></small>
            </div>

            <div class=" form-group col-md-6">
                <label>Actions</label><br>
                <button type="submit" value="submit" class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Create</button>
                <button type="reset" value="reset" id="rest" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Clear</button>
                <hr>
            </div>           
        </form>
    </div>
</section>
@endif
@if(in_array(2,$optionsSuppliers))        
<!-- Esto va en otra vista cuando se presione el boton "Search" -->
        <section id="ReadSuppliers">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" id="suppliersTable">
                        
                    </div>
                </div>
            </div>
        </section>
@endif        
@endsection