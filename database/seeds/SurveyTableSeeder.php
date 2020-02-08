<?php

use App\Models\Komoditas;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

class SurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $faker=new Faker;

        for ($i=0; $i < 100; $i++)
        {
            $survey=new Survey;
            $survey->id_user = $faker->randomElement(['3','4','5']);
            $survey->id_tugas_survey = $faker->numberBetween($min = 1, $max = 10);
            $survey->harga = $faker->randomElement(['2000','2300','4200','4000']);
            $survey->merek ="ini merek";
            $survey->valid = 0;
            $survey->counted_at = $faker->randomElement([Carbon::now(),Carbon::yesterday()]);
            $survey->kenaikan =$faker->randomElement(['naik','stabil','turun']);
            $survey->save();

        }
    }
}
