<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    public function __construct($clienteId, $balance,  $attributes = array())
    {
        parent::__construct($attributes);
        $this->cliente_id = $clienteId;
        $this->balance = $balance;
        $this->crearNumeroCuenta();
    }

    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }

    public function transacciones(){
        return $this->hasMany('App\Trasaccion');
    }


    private function crearNumeroCuenta(){
        $num = rand(10000000,99999999);
        $cuenta = Cuenta::where('numero_cuenta', $num)->firstOrFail();
        if($cuenta == null)
            return $cuenta;
        else crearNumeroCuenta();

        
    }
}
