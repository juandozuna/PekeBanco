<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    //

    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }

    public function transacciones(){
        return $this->hasMany('App\Trasaccion');
    }

    public function tarjetas(){
        return $this->hasMany('App\Tarjeta');
    }

}
