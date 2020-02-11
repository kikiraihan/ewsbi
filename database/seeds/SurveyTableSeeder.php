<?php

use App\Models\TugasSurvey;
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

        //surveyor 3
        for ($i=0; $i < 40; $i++)
        {
            //semua tugas surveyor
            $tugas=TugasSurvey::where('id_instansi',User::find(3)->id_instansi)->get(['id']);
            foreach($tugas as $s) $isi[]=$s->id;

            $survey=new Survey;
            $survey->id_user = 3;//$faker->randomElement(['3','4','5'])
            $survey->id_tugas_survey = $faker->randomElement($isi); //$faker->numberBetween($min = 1, $max = 10);
            $survey->harga = $faker->randomElement(['2000','2300','4200','4000']);
            $survey->merek ="ini merek";
            $survey->valid = 0;

            $survey->counted_at = Carbon::now()->firstOfMonth()->add($i,'day')->format('Y-m-d H:i');//$faker->randomElement([Carbon::now(),Carbon::yesterday()]);
            $survey->kenaikan =$faker->randomElement(['naik','stabil','turun']);
            $survey->save();
        }



        //surveyor 4
        for ($i=0; $i < 40; $i++)
        {
            //semua tugas surveyor
            $tugas=TugasSurvey::where('id_instansi',User::find(4)->id_instansi)->get(['id']);
            foreach($tugas as $s) $isi[]=$s->id;

            $survey=new Survey;
            $survey->id_user = 4;//$faker->randomElement(['3','4','5'])
            $survey->id_tugas_survey = $faker->randomElement($isi); //$faker->numberBetween($min = 1, $max = 10);
            $survey->harga = $faker->randomElement(['2000','2300','4200','4000']);
            $survey->merek ="ini merek";
            $survey->valid = 0;

            $survey->counted_at = Carbon::now()->firstOfMonth()->add($i,'day')->format('Y-m-d H:i');//$faker->randomElement([Carbon::now(),Carbon::yesterday()]);
            $survey->kenaikan =$faker->randomElement(['naik','stabil','turun']);
            $survey->save();
        }


        //surveyor 5
        for ($i=0; $i < 40; $i++)
        {
            //semua tugas surveyor
            $tugas=TugasSurvey::where('id_instansi',User::find(5)->id_instansi)->get(['id']);
            foreach($tugas as $s) $isi[]=$s->id;

            $survey=new Survey;
            $survey->id_user = 5;//$faker->randomElement(['3','4','5'])
            $survey->id_tugas_survey = $faker->randomElement($isi); //$faker->numberBetween($min = 1, $max = 10);
            $survey->harga = $faker->randomElement(['2000','2300','4200','4000']);
            $survey->merek ="ini merek";
            $survey->valid = 0;

            $survey->counted_at = Carbon::now()->firstOfMonth()->add($i,'day')->format('Y-m-d H:i');//$faker->randomElement([Carbon::now(),Carbon::yesterday()]);
            $survey->kenaikan =$faker->randomElement(['naik','stabil','turun']);
            $survey->save();
        }

    }
}


            // tinker
            // $survey=new Survey;
            // $survey->id_user =3;
            // $survey->id_tugas_survey =17;
            // $survey->harga =2000;
            // $survey->merek ="ini merek";
            // $survey->valid = 0;
            // $survey->counted_at = "2020-02-10 14:07:18";
            // $survey->kenaikan ="stabil";
            // $survey->save();