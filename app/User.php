<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function permissions(){
        return $this->hasMany('App\Permission', 'document', 'document');
    }

    public function typeUser(){
        return $this->belongsTo('App\TypeUserModel', 'idtype_user', 'idtype_user');
    }

    protected $primaryKey = 'document';

    public $timestamps = false;
}
