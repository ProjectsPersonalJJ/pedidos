<?php

namespace App\Http\Controllers;

use App\OrdersModel;
use App\SuppliersModel;
use App\ProductsModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.orders',[
            'module' => 5, // module orders
            'suppliers' => SuppliersModel::where('status', 1)->get(['idsupplier','name'])
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
        // pending
        // 1 step validar user
        // 2 step valor total order ??
        // 3 register order
        // 4 register line orders
        dd($request->order['line_orders']);
        //   "order" => array:2 [
        //     "id" => "0"
        //     "line_orders" => array:1 [
        //       0 => array:4 [
        //         "idLineOrder" => "0"
        //         "idProducto" => "1"
        //         "quantity" => "1"
        //         "value" => "10000"
        //       ]
        //     ]
        //   ]
        //   "user" => "123"
        // ]

        return response()->json(['request' => $request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdersModel  $ordersModel
     * @return \Illuminate\Http\Response
     */
    public function show(OrdersModel $ordersModel)
    {
        //
    }
    
    public function pullProductsBySupplier(Request $request)
    {

        $products = ProductsModel::where('idsupplier', $request->idSupplier)->where('status', 1)->get(['idproduct', 'name', 'value']);

        return response()->json([ 'products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdersModel  $ordersModel
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdersModel $ordersModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdersModel  $ordersModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdersModel $ordersModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdersModel  $ordersModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdersModel $ordersModel)
    {
        //
    }
}
