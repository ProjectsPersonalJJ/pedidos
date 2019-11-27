<?php

namespace App\Http\Controllers;

use App\ConfigOrdersModel;
use Illuminate\Http\Request;

class ConfigOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.config_orders', [
            'module' => 4 //Config Orders Controller
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
     * @param  \App\ConfigOrdersModel  $configOrdersModel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $file = __DIR__."\ConfigOrders\configOrders.json";
            try {

               $fp = fopen($file, "r");
               $contents = fread($fp, filesize($file));
               fclose($fp);
               return ($contents);

            } catch (Exception $e) {
               return $e;   
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConfigOrdersModel  $configOrdersModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigOrdersModel $configOrdersModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConfigOrdersModel  $configOrdersModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "quantityOrders" => "required|min:0|max:9",
            "timebegine" => "required",
            "timeend" => "required"
        ]);
        //Pending validation fields
        $file = __DIR__."\ConfigOrders\configOrders.json";
        // Create fiel an write estructure json
        try {
            $fp = fopen($file, 'w');
            fwrite($fp, 
                "{
                \"quantity\": \"$request->quantityOrders\",
                \"timeBegin\": \"$request->timebegine\",
                \"timeEnd\": \"$request->timeend\"
                }");

            fclose($fp);

            return 1;
            
        } catch (Exception $e) {
            return $e;
        }
        
    }

    public function structureJSON($value='')
    {
        # code...
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConfigOrdersModel  $configOrdersModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigOrdersModel $configOrdersModel)
    {
        //
    }
}
