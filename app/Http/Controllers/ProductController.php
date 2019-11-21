<?php

namespace App\Http\Controllers;

use App\ProductsModel;
use App\SuppliersModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.products', [
            'module' => 3,
            'suppliers' => SuppliersModel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Pendiente la validacion
        if ($request->ajax()) {

            $this->validateInformation($request);

            $product = new ProductsModel();
            $product->idsupplier = $request->supplier;
            $product->name = $request->nameProduct;
            $product->value = $request->value;
            $product->save();

            return $product->idproduct;//Se va a retornar el mensaje en vez del id
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductsModel  $productsModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsModel $productsModel, Request $request)
    {

        if ($request->ajax()) {
            $product= null;
            if ($request->all()) {

                $product = ProductsModel::findOrFail($request->idproduct);

                return $product;
            }else{
                $products = ProductsModel::all();

                $table="<table id=\"tabla\" class=\"table table-striped table-bordered\" style=\"width:100%\">";
                $table.="<thead>
                            <th>Supplier</th>
                            <th>Product</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead></tbody>";
                foreach ($products as $product) {
                    $table.="<tr>
                                <td>".($product->supplier->name)."</td>
                                <td>$product->name</td>
                                <td>$product->value</td>
                                <td>"."<span class=\"badge badge-".
                                ($product->status ==1?"success\">Active</span>":"danger\">Desactive</span>")
                                ."</td>
                                <td>
                                    <button value=\"$product->idproduct\" onclick=\"editProduct(this)\" class=\"btn btn-warning btn-sm\"".($product->status==0?"disabled":"")."><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>&nbsp;Edit</button>
                                        <button value=\"$product->idproduct\" class=\"btn btn-".($product->status ==1? "danger btn-sm\" onclick=\"change_status_product(this)\"><i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i>&nbsp;Deactivate</button>": "success btn-sm\" onclick=\"change_status_product(this)\"><i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i>&nbsp;Active</button>")."
                                </td>
                            </tr>";
                }
                $table.="</tbody><tfoot>
                            <th>Supplier</th>
                            <th>Product</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tfoot></table>";

                return json_encode($table);
            }
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductsModel  $productsModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsModel $productsModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductsModel  $productsModel
     * @return \Illuminate\Http\Response
     */
    public function update($idproduct, Request $request)
    {
        if($request->ajax()){

            $this->validateInformation($request);

            $product = ProductsModel::findOrFail($idproduct);
            $product->name = $request->nameProduct;
            $product->idsupplier = $request->supplier;
            $product->value = $request->value;
            $product->save();

            return response()->json([
                'mensaje' => $idproduct
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductsModel  $productsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProduct)
    {
       $product = ProductsModel::where('idproduct', $idProduct)->take(1)->get('status');
       $status = $product[0]->status==1?0:1;
       ProductsModel::where('idproduct',$idProduct)->update([
            'status' => $status
       ]);

       return response()->json([
            "mensaje" => $product
       ]); 
    }

    public function validateInformation($request)
    {
        $validations = $request->validate([
            'nameProduct' => 'required|max:45',
            'suppliers' => 'required|min:1',
            'value' => 'required|max:100000|min:50|numeric|digits_between:2,6'
        ]);

    }
}
