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
            $product = new ProductsModel();
            $product->idsupplier = $request->supplier;
            $product->name = $request->nameProduct;
            $product->value = $request->value;
            $product->save();

            return $product->id;//Se va a retornar el mensaje en vez del id
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
                                <button class=\"btn btn-warning btn-sm disabled\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>&nbsp;Edit</button>
                                <button value=\"$product->idproduct\" data-status=\"$product->status\" class=\"btn btn-success btn-sm\" onclick=\"changeStatusSupplier(this)\"><i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i>&nbsp;Active</button>
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
    public function update(Request $request, ProductsModel $productsModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductsModel  $productsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsModel $productsModel)
    {
        //
    }
}
