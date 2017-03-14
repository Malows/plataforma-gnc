<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 06/03/17
 * Time: 03:18
 */


$factory->define(App\Titular::class, function ( Faker\Generator $faker ) {
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->lastName,
        'dni' => $faker->unique()->randomNumber(),
        'domicilio' => $faker->streetAddress,
        'localidad_id' => $faker->randomDigitNotNull,
        'telefono' => $faker->optional()->phoneNumber,
        'email' => $faker->optional()->safeEmail
    ];
});

