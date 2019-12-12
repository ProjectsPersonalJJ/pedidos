<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineOrdersModel extends Model
{
    protected $table = 'lines_orders';
    protected $primaryKey  = 'idlines_order';
    public $timestamps = false;

    public function order()
    {
    	return $this->belongsTo(OrdersModel::class, 'idorder');
    }

}
