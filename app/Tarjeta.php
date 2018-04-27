<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    /*
    *  En este caso la tarjeta va a funjir como un elemeneto para poder identificar al cliente.
    */

    public function cuenta(){
        return $this->belongsTo('App/Cliente');
    }

}
