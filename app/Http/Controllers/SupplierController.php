<?php

namespace App\Http\Controllers;

use App\SuppliersModel;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.suppliers',[
            "module" => 1 //Subpliers ID
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

        //Validations of pending fields

        if($request->ajax()){

            $supplier = new SuppliersModel();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->save();

            return $supplier->id;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuppliersModel  $suppliersModel
     * @return \Illuminate\Http\Response
     */
    public function show(SuppliersModel $suppliersModel, Request $request)
    {
        if ($request->ajax()) {
            $suppliers = null;
            if ($request->all()) {
                //Send information
                $suppliers = SuppliersModel::where("idsupplier", $request->idsupplier)->take(1)->get();

                return $suppliers;
            }else{
                //Send Table
                $suppliers = SuppliersModel::all();

                $table="<table id=\"tabla\" class=\"table table-striped table-bordered\" style=\"width:100%\">";
                $table.="<thead>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead></tbody>";
                foreach ($suppliers as $supplier) {
                    $table.="<tr>
                                <td>$supplier->name</td>
                                <td>$supplier->email</td>
                                <td>"."<span class=\"badge badge-".
                                ($supplier->status ==1?"success\">Active</span>":"danger\">Desactive</span>")
                                ."</td>
                                <td>
                                    <button value=\"$supplier->idsupplier\" onclick=\"editSupplier(this)\" class=\"btn btn-warning btn-sm\"".($supplier->status==0?"disabled":"")."><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>&nbsp;Edit</button>
                                    <button value=\"$supplier->idsupplier\" data-status=\"$supplier->status\" class=\"btn btn-".($supplier->status ==1? "danger btn-sm\" onclick=\"changeStatusSupplier(this)\"><i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i>&nbsp;Deactivate</button>": "success btn-sm\" onclick=\"changeStatusSupplier(this)\"><i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i>&nbsp;Active</button>")."
                                    
                                </td>
                            </tr>";
                }
                $table.="</tbody><tfoot>
                            <th>Name</th>
                            <th>E-mail</th>
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
     * @param  \App\SuppliersModel  $suppliersModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuppliersModel  $suppliersModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idsupplier)
    {
        if($request->ajax()){

            SuppliersModel::where('idsupplier', $idsupplier)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            return $idsupplier;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuppliersModel  $suppliersModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($idsupplier)
    {
        try {
            $supplier = SuppliersModel::where('idsupplier', $idsupplier)->get('status');
            // dd($supplier);
            $status = $supplier[0]->status==1?0:1;
            SuppliersModel::where('idsupplier', $idsupplier)->update([
                'status' => $status
            ]);

            return response()->json([
                "mensaje" => $status
            ]);
        } catch (Exception $e) {
            return null;
        }
    }
}
