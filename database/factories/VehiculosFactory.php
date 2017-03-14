<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 06/03/17
 * Time: 04:20
 */
$factory->define( App\Vehiculo::class, function ( Faker\Generator $faker ) {
    return [
        'dominio' => strtoupper($faker->bothify('??? ###')),
        'titular_id' => $faker->numberBetween(1,20),
        'marca_id' => $faker->numberBetween(1,10),
        'modelo_id' => $faker->numberBetween(1,30),
        'año' => $faker->year
    ];
});