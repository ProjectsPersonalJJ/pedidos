<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'idpermission';

    public function module(){
        return $this->belongsTo('App\Module', 'idmodule', 'idmodule');
    }
}
