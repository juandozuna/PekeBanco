<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //


    /*
    public function __construct($nombre = '', $apellido = '', $fecha = null, $attributes = array())
    {
        parent::__construct($attributes);
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha;
    }
*/


    protected $hidden = ['created_at', 'updated_at'];

    protected $table = "clientes";


    public function cuentas(){
        return $this->hasMany('App\Cuenta');
    }

    public function tarjeta(){
        return $this->hasOne('App\Tarjeta');
    }

    public function nombre_completo(){
        return $this->nombre." ".$this->apellido;
    }

}
