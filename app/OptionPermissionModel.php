<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionPermissionModel extends Model
{
    protected $table = 'options_permissions';
    protected $primaryKey  = 'idoption_permission';
    public $timestamps = false;
}
