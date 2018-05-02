<?php

use Illuminate\Database\Seeder;

class TransaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Transaccion::class, 70)->create()->each(function($t){
            $c = $t->cuenta;
            
            if($t->tipo == "Retiro")
                $c->balance -= $t->amount;
            else
                $c->balance += $t->amount;
            
            $t->balance = $c->balance;
            $t->save();
            $c->save();
        });
    }
}
