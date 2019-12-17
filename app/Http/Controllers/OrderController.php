<?php

namespace App\Http\Controllers;

use App\OrdersModel;
use App\LineOrdersModel;
use App\SuppliersModel;
use App\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        if ($request->ajax()) {

            $request->validate(['password' => 'required|max:8']);

            // 1 step validar user
            if (Hash::check($request->password, Auth::user()->password)) {

                // 2 step valor total order ??
                $totalValue = 0;
                $value = 0;
                DB::beginTransaction();
                try {

                    foreach ($request->order["line_orders"] as $product) {

                        $value = (int) ProductsModel::where('idproduct', $product['idProducto'])->take(1)->get(['value'])[0]->value;
                        $product['value'] = $value;
                        $totalValue += ($value * $product['quantity']);

                    }
                    // 3 register order
                    $order = new OrdersModel();
                    $order->user_document = Auth::user()->document;
                    $order->order_total = $totalValue;
                    $order->save();

                    $idorder = $order->idorder;

                    $line_product = null;
                    // 4 register line orders
                    foreach ($request->order["line_orders"] as $product) {

                        $line_product = new LineOrdersModel();

                        $line_product->orders_idorder = $idorder;
                        $line_product->idproduct = $product['idProducto'];
                        $line_product->value_product = $product['value'];
                        $line_product->quantity = $product['quantity'];
                        $line_product->save();
                        $line_product = null;
                    }
                    DB::commit();
                    return response()->json(['message' => $idorder]);

                } catch ( \Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'message' => 'Error transaction'
                    ]);
                }

            }else{

                return response()->json([
                    'message' => 'Incorrect password'
                ]);

            }

        }

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
    
    public function ordersRanchDate(Request $request)
    {
        if ($request->ajax()) {
            // dd($request);
            $orders = OrdersModel::where('datetime_order','>=', $request->start)
                        ->where('datetime_order','<=', $request->end)->where('user_document', Auth::user()->document)->get(['idorder','datetime_order','order_total']);
            $table = "";

            foreach ($orders as $order) {
                $table .= "<tr>
                                <td>$order->datetime_order</td>
                                <td>$order->order_total</td>
                                <td>
                                <button class=\"btn btn-warning btn-sm\" onclick=\"editOrder(this)\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>&nbsp;Edit</button>
                                <button class=\"btn btn-danger btn-sm\" onclick=\"destroyOrder(this)\"><i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i>&nbsp;Delete</button>
                                </td>
                            </tr>";
            }

            return $table;
        }
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
