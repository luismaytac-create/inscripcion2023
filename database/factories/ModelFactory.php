<?php

use App\Models\Postulante;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'dni' => $faker->name,
        'password' => 'secret',
        'foto'=> 'avatar/nofoto.jpg',
        'activo' => true,
        'remember_token' => str_random(10),
    ];
});
$factory->define(Postulante::class, function (Faker\Generator $faker) {
    return [
        'idevaluacion' => 1,
        'paterno' => $faker->firstName,
        'materno' => $faker->lastName,
        'nombres' => $faker->name,
        'dni' => $faker->randomNumber($nbDigits = 8),
        'telefono' => $faker->phoneNumber,
        'email' => $faker->email,
        'idsexo' => $faker->randomElement($array = array (11,12)),
        'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'idgrado' => $faker->numberBetween($min = 13, $max = 18),
    ];
});
