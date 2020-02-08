<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(InstansiTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(KomoditasTableSeeder::class);
        $this->call(LokasiTableSeeder::class);
        $this->call(TugasSurveyTableSeeder::class);
        $this->call(SurveyTableSeeder::class);
    }
}
