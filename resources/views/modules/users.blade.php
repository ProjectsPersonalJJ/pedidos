@extends('layout.base')

@section('content')

    <section class="home_gallery_area">
        <div class="container">
            <form class="row form_inputs" method="post" id="" novalidate="novalidate">

                <div class="col-md-12 text-center">
                    <label class="h1">Form Users</label>
                    <hr>
                </div>
                <div class="form-group col-md-6">
                    <label for="document">Document:</label>
                    <input type="number" min="0" class="form-control" id="document" name="document" placeholder="Your number document">
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                </div>

                <div class="form-group col-md-6">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Your last name">
                </div>
                <div class="form-group col-md-6">
                    <label for="brith">Birth:</label>
                    <input type="date" class="form-control" id="brith" name="brith" placeholder="Your brith">
                </div>

                <div class="form-group col-md-4">
                    <label>Sexo:</label>
                    <div class="gender">
                        <label><input type="radio" class="" id="femenino" value="0" name="sexo">F</label>
                        <label><input type="radio" class="" id="masculino" value="1" name="sexo">M</label>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your E-mail">
                </div>

                <div class="form-group col-md-6">
                    <label>Type User</label>
                    <select class="form-control w-100" id="type-users">
                          <option class="w-100" value="">1</option>
                          <option class="w-100" value="">2</option>
                          <option class="w-100" value="">3</option>
                          <option class="w-100" value="">4</option>
                          <option class="w-100" value="">5</option>
                    </select>
                </div>   
                <div class=" form-group col-md-6">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Your password">
                </div>  

                <div class=" form-group col-md-6">
                    <label for="password-confirm">Confirm password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                </div>   
                <div class=" form-group col-md-6">
                    <label>Actions</label><br>
                    <button type="button" value="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalConfirm"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Create</button>
                    <a class="btn btn-primary" href="#"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</a>
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
                                <th>Document</th>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Genered</th>
                                <th>Brith</th>
                                <th>Type User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1216727816</td>
                                <td>Juan David</td>
                                <td>Marulanda Paniagua</td>
                                <td>M</td>
                                <td>30/11/1998</td>
                                <td>Admin</td>
                                <td>
                                    <button class="btn btn-warning btn-sm disabled"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
                                    <button class="btn btn-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;Active</button>
                                    <button class="btn btn-primary btn-sm"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Permissions</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1216727816</td>
                                <td>Juan David</td>
                                <td>Marulanda Paniagua</td>
                                <td>M</td>
                                <td>30/11/1998</td>
                                <td>Client</td>
                                <td>
                                  <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
                                  <button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbsp;Delete</button>
                                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPermissions"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Permissions</button>

                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Document</th>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Genered</th>
                                <th>Brith</th>
                                <th>Type User</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
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