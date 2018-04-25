<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //

    protected $table = "clientes";


    public function cuentas(){
        return $this->hasMany('App\Cuenta');
    }

}
