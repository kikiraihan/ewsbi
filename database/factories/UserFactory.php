<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'kategori' => $faker->randomElement(['Supervisor','Admin', 'Surveyor']) ,
        'id_instansi' => $faker->randomElement(['1','2','3']) ,
        'username' => $faker->username,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',//'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
