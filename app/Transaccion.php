<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    //


    public function cuenta(){
        return $this->belongsTo('App\Cuenta'); 
    }
}
