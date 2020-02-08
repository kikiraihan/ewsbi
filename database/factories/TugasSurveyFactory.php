<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\TugasSurvey;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(TugasSurvey::class, function (Faker $faker) {
    return [
        'id_komoditas'=> $faker->numberBetween($min = 1, $max = 30),
        'id_lokasi'=> $faker->randomElement(['1','2','3']),
        'id_instansi'=> $faker->randomElement(['1','2','3','4']),
    ];
});
