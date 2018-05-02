<?php

use Faker\Generator as Faker;

$factory->define(App\Transaccion::class, function (Faker $faker) {
    return [
        'tipo' => $faker->randomElement(['Retiro', 'Deposito']),
        'amount' => $faker->numberBetween(50, 200),
        'balance' => 0,
        'cuenta_id' => $faker->numberBetween(1,30),
    ];
});
