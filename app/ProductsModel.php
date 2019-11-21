<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = "products";
	protected $primaryKey="idproduct";
    public $timestamps = false;

    public function supplier()
    {
    	return $this->belongsTo(SuppliersModel::class, 'idsupplier');
    }

}
