<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Instansi;
use Faker\Generator as Faker;

$factory->define(Instansi::class, function (Faker $faker) {

    return [
        'nama_instansi' => $faker->randomElement(['Bappeda','Pertanahan','Dinas Lain']) ,
        'alamat' => $faker->address,
    ];


});
