<?php

use Illuminate\Database\Seeder;
use App\Models\TugasSurvey;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

class TugasSurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // for ($i=0; $i < 30; $i++)
        // {
        //     $task=new TugasSurvey;
        //     $task->id_komoditas= $faker->numberBetween($min = 1, $max = 30);
        //     $task->id_lokasi= $faker->randomElement(['1','2','3']);
        //     $task->id_instansi= $faker->randomElement(['1','2','3']);

        //     $task->save();
        // }

        factory(App\Models\TugasSurvey::class,20)
        ->create();
    }
}
