<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
	protected $primary_key="idproduct";
    protected $table = "products";
    public $timestamps = false;

}
