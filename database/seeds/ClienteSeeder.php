<?php

use Illuminate\Database\Seeder;
use App\Tarjeta;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cliente::class, 20)->create()->each(function ($c){
            $c->hashed_id = Crypt::encryptString($c->id);
            $tarjeta = new Tarjeta();
            $tarjeta->codigoTarjeta = mt_rand(7123000000000000, 8932999999999999);
            $tarjeta->cliente_id = $c->id;
            $tarjeta->save();
            $c->save();
        });
    }   
}
