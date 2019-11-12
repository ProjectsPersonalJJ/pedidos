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
                            <td id=\"$supplier->idsupplier\">$supplier->name</td>
                            <td>$supplier->email</td>
                            <td>"."<span class=\"badge badge-".
                            ($supplier->status ==1?"success\">Active</span>":"danger\">Desactive</span>")
                            ."</td>
                            <td>
                                <button class=\"btn btn-warning btn-sm disabled\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>&nbsp;Edit</button>
                                <button class=\"btn btn-success btn-sm\"><i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i>&nbsp;Active</button>
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuppliersModel  $suppliersModel
     * @return \Illuminate\Http\Response
     */
    public function edit(SuppliersModel $suppliersModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuppliersModel  $suppliersModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuppliersModel $suppliersModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuppliersModel  $suppliersModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuppliersModel $suppliersModel)
    {
        //
    }
}
