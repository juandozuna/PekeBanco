<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //

     function __construct($nombre, $apellido, $fecha, $attributes = array())
    {
        parent::__construct($attributes);
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha;
    }


    protected $table = "clientes";


    public function cuentas(){
        return $this->hasMany('App\Cuenta');
    }

}
