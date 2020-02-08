<?php

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lokasi::create([
            'nama' => 'Pasar Sentral',
            'jenis_pasar' => 'Tradisional',
            'alamat' => 'Jl.Imam Bonjour Bon Apetite'
        ]);

        Lokasi::create([
            'nama' => 'Pasar Selasa',
            'jenis_pasar' => 'Tradisional',
            'alamat' => 'Jl.Roberto Carlos Satu Kosong'
        ]);

        Lokasi::create([
            'nama' => 'Pasar Malam',
            'jenis_pasar' => 'Tradisional',
            'alamat' => 'Jl.Jalan Ke Ladang Ubur2'
        ]);

        Lokasi::create([
            'nama' => 'Toko Bangunan Pusat',
            'jenis_pasar' => 'Toko Bangunan',
            'alamat' => 'Jl.Ronaldinho Oreo'
        ]);

    }
}
