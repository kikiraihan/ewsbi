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


        Komoditas::create(['nama' => 'Beras', 'kategori' => 'Pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Minyak Goreng', 'kategori' => 'Pangan','satuan' => 'Liter']);

        Komoditas::create(['nama' => 'Daging Sapi', 'kategori' => 'Pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Daging Ayam Ras', 'kategori' => 'Pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Telur Ayam Ras', 'kategori' => 'Pangan','satuan' => 'Butir']);
        Komoditas::create(['nama' => 'Ayam Hidup', 'kategori' => 'Pangan','satuan' => 'Ekor']);
        Komoditas::create(['nama' => 'Cabe Merah', 'kategori' => 'Pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Bawang', 'kategori' => 'Pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Tomat', 'kategori' => 'Pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Tomat Buah', 'kategori' => 'Pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Pepaya', 'kategori' => 'Pangan','satuan' => 'Buah']);
        Komoditas::create(['nama' => 'Pisang Gapi', 'kategori' => 'Pangan','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Kangkung', 'kategori' => 'Pangan','satuan' => 'Ikat']);
        Komoditas::create(['nama' => 'Terong', 'kategori' => 'Pangan','satuan' => 'Ikat']);
        Komoditas::create(['nama' => 'Tempe', 'kategori' => 'Pangan','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Tahu Mentah', 'kategori' => 'Pangan','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Kelapa', 'kategori' => 'Pangan','satuan' => 'Butir']);
        Komoditas::create(['nama' => 'Ikan', 'kategori' => 'Pangan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Udang Basah', 'kategori' => 'Pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Gula Pasir', 'kategori' => 'Pangan','satuan' => 'Kg']);
        Komoditas::create(['nama' => 'Susu Bubuk', 'kategori' => 'Pangan','satuan' => ' 900gr']);

        Komoditas::create(['nama' => 'Air Minum Kemasan', 'kategori' => 'Pangan','satuan' => 'Karton']);
        Komoditas::create(['nama' => 'Mie Instan', 'kategori' => 'Pangan','satuan' => 'Bungkus']);

        Komoditas::create(['nama' => 'Rokok', 'kategori' => 'Pangan','satuan' => 'Bungkus']);


        // Komoditas::create(['nama' => 'Batu Bata', 'kategori' => 'Pangan','satuan' => 'Bungkus']);
        // Komoditas::create(['nama' => 'Pasir']);

        Komoditas::create(['nama' => 'Kaos', 'kategori' => 'Sandang','satuan' => 'Pcs']);
        Komoditas::create(['nama' => 'Kameja', 'kategori' => 'Sandang','satuan' => 'Pcs']);

        Komoditas::create(['nama' => 'Semen', 'kategori' => 'Papan','satuan' => 'Sak']);
        Komoditas::create(['nama' => 'Cat Tembok', 'kategori' => 'Papan','satuan' => 'Kg']);

        Komoditas::create(['nama' => 'Sabun Deterjen Bubuk', 'kategori' => 'Papan','satuan' => 'Bungkus']);
        Komoditas::create(['nama' => 'Emas', 'kategori' => 'Papan','satuan' => 'gram']);
        Komoditas::create(['nama' => 'Minyak Tanah', 'kategori' => 'Papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Premium', 'kategori' => 'Papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Solar', 'kategori' => 'Papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Gas Elpiji 3 Kg', 'kategori' => 'Papan','satuan' => 'Tabung']);
        Komoditas::create(['nama' => 'Gas Elpiji 12 Kg', 'kategori' => 'Papan','satuan' => 'Tabung']);

        Komoditas::create(['nama' => 'Pertalite', 'kategori' => 'Papan','satuan' => 'Liter']);
        Komoditas::create(['nama' => 'Pertamax', 'kategori' => 'Papan','satuan' => 'Liter']);






















        // $komoditas =new Komoditas();
        // $komoditas->id_instansi=1;
        // $komoditas->nama="Beras";
        // $komoditas->merek="Beras IR 64 Premium";
        // $komoditas->kategori="Pangan";//Pangan, Sandang
        // $komoditas->lokasi="Pasar Sentral";
        // $komoditas->jenis_pasar="pasar_tradsional"; //pasar_tradsional, pasar_modern, pedagang_besar
        // $komoditas->satuan="Liter";
        // $komoditas->save();


    }
}
