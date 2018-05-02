<?php

use Faker\Generator as Faker;

$factory->define(App\Cuenta::class, function (Faker $faker) {
    return [
        'balance' => $faker->numberBetween(500, 1500),
        'numero_cuenta' => mt_rand(1000000000, 9999999999),
        'cliente_id' => $faker->numberBetween(1,20)
    ];
});
