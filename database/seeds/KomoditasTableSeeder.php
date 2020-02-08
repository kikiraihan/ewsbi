<?php

use Illuminate\Database\Seeder;
use App\Models\Komoditas;
use Faker\Generator as Faker;

class KomoditasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = new Faker();
        // $faker->randomElement([1,2,'3']);


        Komoditas::create(['nama' => 'Beras', 'kategori' => 'pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Minyak Goreng', 'kategori' => 'pangan','satuan' => 'Liter']);

        Komoditas::create(['nama' => 'Daging Sapi', 'kategori' => 'pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Daging Ayam Ras', 'kategori' => 'pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Telur Ayam Ras', 'kategori' => 'pangan','satuan' => 'Butir']);
        Komoditas::create(['nama' => 'Ayam Hidup', 'kategori' => 'pangan','satuan' => 'Ekor']);
        Komoditas::create(['nama' => 'Cabe Merah', 'kategori' => 'pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Bawang', 'kategori' => 'pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Tomat', 'kategori' => 'pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Tomat Buah', 'kategori' => 'pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Pepaya', 'kategori' => 'pangan','satuan' => 'Buah']);
        Komoditas::create(['nama' => 'Pisang Gapi', 'kategori' => 'pangan','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Kangkung', 'kategori' => 'pangan','satuan' => 'Ikat']);
        Komoditas::create(['nama' => 'Terong', 'kategori' => 'pangan','satuan' => 'Ikat']);
        Komoditas::create(['nama' => 'Tempe', 'kategori' => 'pangan','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Tahu Mentah', 'kategori' => 'pangan','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Kelapa', 'kategori' => 'pangan','satuan' => 'Butir']);
        Komoditas::create(['nama' => 'Ikan', 'kategori' => 'pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Udang Basah', 'kategori' => 'pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Gula Pasir', 'kategori' => 'pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Susu Bubuk', 'kategori' => 'pangan','satuan' => ' 900gr']);

        Komoditas::create(['nama' => 'Air Minum Kemasan', 'kategori' => 'pangan','satuan' => 'Karton']);
        Komoditas::create(['nama' => 'Mie Instan', 'kategori' => 'pangan','satuan' => 'Bungkus']);

        Komoditas::create(['nama' => 'Rokok', 'kategori' => 'pangan','satuan' => 'Bungkus']);


        // Komoditas::create(['nama' => 'Batu Bata', 'kategori' => 'pangan','satuan' => 'Bungkus']);
        // Komoditas::create(['nama' => 'Pasir']);

        Komoditas::create(['nama' => 'Kaos', 'kategori' => 'sandang','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Kameja', 'kategori' => 'sandang','satuan' => 'Pcs']);

        Komoditas::create(['nama' => 'Semen', 'kategori' => 'papan','satuan' => 'Sak']);
        Komoditas::create(['nama' => 'Cat Tembok', 'kategori' => 'papan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Sabun Deterjen Bubuk', 'kategori' => 'papan','satuan' => 'Bungkus']);
        Komoditas::create(['nama' => 'Emas', 'kategori' => 'papan','satuan' => 'gram']);
        Komoditas::create(['nama' => 'Minyak Tanah', 'kategori' => 'papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Premium', 'kategori' => 'papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Solar', 'kategori' => 'papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Gas Elpiji 3 Kg', 'kategori' => 'papan','satuan' => 'Tabung']);
        Komoditas::create(['nama' => 'Gas Elpiji 12 Kg', 'kategori' => 'papan','satuan' => 'Tabung']);

        Komoditas::create(['nama' => 'Pertalite', 'kategori' => 'papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Pertamax', 'kategori' => 'papan','satuan' => 'Liter']);






















        // $komoditas =new Komoditas();
        // $komoditas->id_instansi=1;
        // $komoditas->nama="Beras";
        // $komoditas->merek="Beras IR 64 Premium";
        // $komoditas->kategori="Pangan";//pangan, sandang
        // $komoditas->lokasi="Pasar Sentral";
        // $komoditas->jenis_pasar="pasar_tradsional"; //pasar_tradsional, pasar_modern, pedagang_besar
        // $komoditas->satuan="Liter";
        // $komoditas->save();


    }
}
