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
        //
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
    public function pullProductsBySupplier($id, Request $request)
    {
        # code...
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
