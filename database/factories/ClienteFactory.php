<?php

use Faker\Generator as Faker;

$factory->define(App\Cliente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'fecha_nacimiento'=> $faker->dateTime($max='now'),
        'trashed' => false
    ];
});


