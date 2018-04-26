<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    //



    public function cuenta(){
        return $this->belongsTo('App/Cuenta');
    }

}
