<?php

use Illuminate\Database\Seeder;
use App\Models\Instansi;
// use Faker\Generator as Faker;

class InstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $faker=new Faker();
        // factory(App\Models\Instansi::class,3)
        // ->create();

        $instansi =new Instansi();
        $instansi->nama_instansi="Bapppeda";
        $instansi->alamat="Jl. ByPass, Tamalate";
        $instansi->save();

        $instansi =new Instansi();
        $instansi->nama_instansi="Pertanahan";
        $instansi->alamat="Jl. Tortelini, Bikini Bottom";
        $instansi->save();

        $instansi =new Instansi();
        $instansi->nama_instansi="Pertanian";
        $instansi->alamat="Jl. Jalan kepasar baru, naik gojek";
        $instansi->save();

        $instansi =new Instansi();
        $instansi->nama_instansi="Dinas Lain";
        $instansi->alamat="Jl. Pulang, Kota Mati";
        $instansi->save();

    }
}
