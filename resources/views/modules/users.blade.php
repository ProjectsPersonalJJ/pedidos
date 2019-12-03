@extends('layout.base')

@include('layout.fade_loading')

@section('content')

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
<!-- Esto va en otra vista cuando se presione el boton "Search" -->
<section id="ReadUsers">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="usersTable">
                    
                </div>
            </div>
        </div>
    </section>
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
                <form class="" method="POST" action="" novalidate="novalidate">
                    <div class="row">
                        <div class="card-group">
                          <div class="card border-bottom-0 border-top-0">
                            <div class="card-body">
                                <section id="CardHome">
                                    <h5 class="card-title">Home&nbsp;<input type="checkbox" id="exampleCheck1"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                      <div class="row">
                                          <label class="h6">Day Orders:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <label class="h6">Products by suppliers:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                      </div>
                                    </div> 
                                </section><br>
                                <section id="CardOrders">
                                    <h5 class="card-title">Orders&nbsp;<input type="checkbox" id="exampleCheck1"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Delete</label>
                                          </div>
                                      </div><br>
                                      <div class="row">
                                          <label class="h6">Settlement:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <label class="h6">Config Orders:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
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
                                    <h5 class="card-title">Users&nbsp;<input type="checkbox" id="exampleCheck1"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Delete</label>
                                          </div>
                                      </div><br>
                                      <div class="row">
                                          <label class="h6">Permissions:</label>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Update</label>
                                          </div>
                                      </div>
                                    </div>
                                </section>
                            </div>
                          </div>
                          <div class="card border-bottom-0 border-top-0">
                            <div class="card-body">
                                <section id="CardSuppliers">
                                    <h5 class="card-title">Suppliers&nbsp;<input type="checkbox" id="exampleCheck1"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                        <div class="row">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Delete</label>
                                          </div>
                                      </div>
                                    </div>
                                </section><br>
                                <section id="CardProducts">
                                    <h5 class="card-title">Products&nbsp;<input type="checkbox" id="exampleCheck1"><small class="text-muted">all</small></h5>
                                    <div class="container">
                                        <div class="row">
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Create</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Read</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Update</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input type="checkbox" id="" name="">
                                              <label>Delete</label>
                                          </div>
                                      </div>
                                    </div>
                                </section>
                            </div>
                          </div>
                        </div>
                    </div>
                </form>
                <!--  -->
             </div>
             <div class="modal-footer">
                <button class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
             </div>
           </div>
         </div>
    </div>
    <!-- ========================= End Modal Permissions ==================================== -->

@endsection