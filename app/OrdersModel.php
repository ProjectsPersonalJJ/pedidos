<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey  = 'idorder';
    public $timestamps = false;
    // const CREATED_AT = 'datetime_order';

    public function lineorders()
    {
    	return $this->hasMany(LineOrdersModel::class, 'idlines_order');
    }
}
