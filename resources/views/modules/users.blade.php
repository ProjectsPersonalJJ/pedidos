@extends('layout.base')

@include('layout.fade_loading')

@section('content')
@if(in_array(1,$optionUser))
    <section class="home_gallery_area">
        <div class="container">
            <form id="formCreateUser" class="row form_inputs" method="post" novalidate="novalidate">
                @csrf
                <div class="col-md-12 text-center">
                    <label class="h1">Users form&nbsp;<small id="title-form"></small></label>
                    <hr>
                </div>
                <div class="form-group col-md-3 hideOrShow">
                    <label for="document">Document:</label>
                    <input type="text" class="form-control" id="document" name="document" placeholder="Number document">
                    <div class="text-danger" name="document"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    <div class="text-danger" name="name"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name">
                    <div class="text-danger" name="lastName"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="birth">Birth date:</label>
                    <input type="date" class="form-control" id="birth" name="birthDate" placeholder="Brith date">
                    <div class="text-danger" name="birthDate"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label>Gender:</label>
                    <div class="gender">
                        <label><input type="radio" id="femenino" value="0" name="gender">F</label>
                        <label><input type="radio" id="masculino" value="1" name="gender">M</label>
                    </div>
                    <div class="text-danger" name="gender"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    <div class="text-danger" name="email"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label>Type User</label>
                    <select class="form-control w-100" id="typeUser" name="typeUser">
                        <option class="w-100" value="">Select...</option>
	                    @foreach($typeUsers as $typeUser)
							<option class="w-100" value="{{$typeUser->idtype_user}}">{{ $typeUser->name_type_user}}</option>
	                    @endforeach
                    </select>
                    <div class="text-danger" name="typeUser"><small><ul></ul></small></div>
                </div>   
                <div class="form-group col-md-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Your password">
                    <div class="text-danger" name="password"><small><ul></ul></small></div>
                </div>  

                <div class=" form-group col-md-3">
                    <label for="password-confirm">Confirm password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password">
                    <div class="text-danger" name="password_confirmation"><small><ul></ul></small></div>
                </div>   
                <div class=" form-group col-md-6">
                    <label>Actions</label><br>
                    <button type="submit" value="submit" class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Create</button>
                    <button type="reset" value="reset" id="rest" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Clear</button>
                    <hr>
                </div>
                                

                <!-- <div class="form-group col-md-12">
                    <button type="submit" value="submit" class="btn submit_btn form-control">Iniciar</button>
                </div> -->
            </form>
        </div>
    </section>
@endif

@if(in_array(2,$optionUser))
<!-- Esto va en otra vista cuando se presione el boton "Search" -->
<section id="ReadUsers">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="usersTable">
                    
                </div>
            </div>
        </div>
</section>
@endif
    <!-- ========================= Modal Permissions ==================================== -->
     <div class="modal fade" id="modalPermissions" role="dialog">
         <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="modal-title">Permissions</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                <!--  -->
                <form id="formUpdatePermissions" method="POST" novalidate="novalidate">
                    @csrf
                    <div class="row">
                        <div class="card-group">
                          <div class="card border-bottom-0 border-top-0">
                            <div class="card-body">
                                <section id="CardHome">
                                    <h5 class="card-title">Home&nbsp;<input value="Home" type="checkbox" id="HomeAll" onclick="checkBoxAll(this)"><small class="text-muted">all</small></h5>
                                    <div class="container" id="Home">
                                      <div class="row">
                                          <label class="h6">Day Orders:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="dayOrders" name="dayOrders">
                                              <label>Read</label>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <label class="h6">Products by suppliers:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="productsBySuppliers" name="productsBySuppliers">
                                              <label>Read</label>
                                          </div>
                                      </div>
                                    </div> 
                                </section><br>
                                <section id="CardOrders">
                                    <h5 class="card-title">Orders&nbsp;<input value="Orders" id="OrdersAll" onclick="checkBoxAll(this)" type="checkbox"><small class="text-muted">all</small></h5>
                                    <div class="container" id="Orders">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="OrdersCreate" name="OrdersCreate">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" value="" onclick="checkBoxRead(this,'Orders')" id="OrdersRead" name="OrdersRead">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" value="" onclick="checkBoxUpdateOrDelete(this,'Orders')" id="OrdersUpdate" name="OrdersUpdate">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" value="" onclick="checkBoxUpdateOrDelete(this, Orders)" id="OrdersDelete" name="OrdersDelete">
                                              <label>Delete</label>
                                          </div>
                                      </div><br>
                                      <div class="row">
                                          <label class="h6">Settlement:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="OrdersSettlement" name="OrdersSettlement">
                                              <label>Read</label>
                                          </div>
                                      </div>
                                    </div>
                                    <section id="CardConfigOrders">
                                        <h5 class="card-title">Config Orders:&nbsp;<input value="OrdersConfigurations" id="OrdersConfigurationsAll" onclick="checkBoxAll(this)" type="checkbox"><small class="text-muted">all</small></h5>
                                        <label class="h6"></label>
                                        <div class="container">
                                            <div class="row" id="OrdersConfigurations">
                                                <div class="col-md-12">
                                                    <input type="checkbox" value="" onclick="checkBoxRead(this,'OrdersConfigurations')" id="OrdersConfigurationsRead" name="OrdersConfigurationsRead">
                                                    <label>Read</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="checkbox" value="" onclick="checkBoxUpdateOrDelete(this,'OrdersConfigurations')" id="OrdersConfigurationsUpdate" name="OrdersConfigurationsUpdate">
                                                    <label>Update</label>
                                                </div>
                                            </div>
                                        </div>
                                </section>
                            </div>
                          </div>
                          <div class="card border-bottom-0 border-top-0">
                            <div class="card-body">
                                <section id="CardUsers">
                                    <h5 class="card-title">Users&nbsp;<input value="Users" id="UsersAll" type="checkbox" onclick="checkBoxAll(this)"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                      <div class="row" id="Users">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="UsersCreate" name="UsersCreate">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxRead(this,'Users')" id="UsersRead" name="UsersRead">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxUpdateOrDelete(this,'Users')" id="UsersUpdate" name="UsersUpdate">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxUpdateOrDelete(this,'Users')" id="UsersDelete" name="UsersDelete">
                                              <label>Delete</label>
                                          </div>
                                      </div><br>
                                    </div>
                                </section>
                                <section id="CardPermissions">
                                        <h5 class="card-title">Permissions&nbsp;<input value="Permissions" id="PermissionsAll" type="checkbox" onclick="checkBoxAll(this)"><small class="text-muted">all</small></h5>
                                        <div class="container">
                                          <div class="row" id="Permissions">
                                              <div class="col-md-12">
                                                  <input type="checkbox" value="" onclick="checkBoxRead(this, 'Permissions')" id="PermissionsRead" name="PermissionsRead">
                                                  <label>Read</label>
                                              </div>
                                              <div class="col-md-12">
                                                  <input type="checkbox" value="" onclick="checkBoxUpdateOrDelete(this, 'Permissions')" id="PermissionsUpdate" name="PermissionsUpdate">
                                                  <label>Update</label>
                                              </div>
                                          </div><br>
                                        </div>
                                </section>
                            </div>
                          </div>
                          <div class="card border-bottom-0 border-top-0">
                            <div class="card-body">
                                <section id="CardSuppliers">
                                    <h5 class="card-title">Suppliers&nbsp;<input value="Suppliers" type="checkbox" id="SuppliersAll" onclick="checkBoxAll(this)"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                        <div class="row" id="Suppliers">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="SuppliersCreate" name="SuppliersCreate">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxRead(this, 'Suppliers')" id="SuppliersRead" name="SuppliersRead">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxUpdateOrDelete(this, 'Suppliers')" id="SuppliersUpdate" name="SuppliersUpdate">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxUpdateOrDelete(this, 'Suppliers')" id="SuppliersDelete" name="SuppliersDelete">
                                              <label>Delete</label>
                                          </div>
                                      </div>
                                    </div>
                                </section><br>
                                <section id="CardProducts">
                                    <h5 class="card-title">Products&nbsp;<input value='Products' id="ProductsAll" type="checkbox" onclick="checkBoxAll(this)"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                        <div class="row" id="Products">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="ProductsCreate" name="ProductsCreate">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxRead(this,'Products')" id="ProductsRead" name="ProductSRead">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxUpdateOrDelete(this, 'Products')" id="ProductsUpdate" name="ProductsUpdate">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" onclick="checkBoxUpdateOrDelete(this, 'Products')" id="ProductsDelete" name="ProductsDelete">
                                              <label>Delete</label>
                                          </div>
                                      </div>
                                    </div>
                                </section>
                            </div>
                          </div>
                          
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
                    </div>
                </form>
                <!--  -->
             </div>
             <div class="modal-footer">
                
             </div>
           </div>
         </div>
    </div>
    <!-- ========================= End Modal Permissions ==================================== -->

@endsection