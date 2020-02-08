<?php

namespace App\Traits;

use App\Charts\jumlahUser;
use App\Models\Instansi;
use App\Models\Komoditas;
use App\Models\Survey;
use App\Models\TugasSurvey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

trait chartTrait
{

    public function chartUser()
    {
        $groupByIdLokasi=TugasSurvey::with(['survey','lokasi','komoditas'])
        ->where('id_instansi', Auth::user()->id_instansi )
        ->has('survey')
        ->get()
        ->groupBy('id_lokasi')
        ;

        //PEMBUATAN CHART
        foreach ($groupByIdLokasi as $id_lokasi => $tugasLokasiA)
        {
            foreach ($tugasLokasiA as $tugas) {
                $nama_lokasi=$tugas->lokasi->nama;
                $nama_komoditas=$tugas->komoditas->nama;

                $harga=null;
                $tgl=null;



                foreach ($tugas->survey->sortBy('counted_at') as $su)
                {
                    $harga[]= $su->harga;
                    $t=new Carbon($su->counted_at);
                    $tgl[]= $t->format('M-d');//Y H:i
                }
                // dd($harga);


                $chart[$nama_lokasi][$nama_komoditas]=new jumlahUser;
                $chart[$nama_lokasi][$nama_komoditas]->labels($tgl);
                $chart[$nama_lokasi][$nama_komoditas]->dataset($nama_komoditas, 'line', $harga)->color('#5f92e3')
                // ->color($faker->randomElement(['#5f92e3','#4ecca1','#98cc4e','#cc8b4e']))
                ;

                // $chart[$nama_lokasi][$nama_komoditas]->setResponsive(true);
                // $chart[$nama_lokasi][$nama_komoditas]->minimalist(true);
                // $chart[$nama_lokasi][$nama_komoditas]->displayLegend(true);
                // $chart[$nama_lokasi][$nama_komoditas]->barWidth(200);
            }
        }

        // dd($groupByInstansi);
        return $chart;
    }



    public function chartAdmin()
    {

        $groupByInstansi=TugasSurvey::with(['survey','lokasi','komoditas'])
        ->has('survey')
        // orderBy('counted_at','ASC')
        ->get()
        ->groupBy(['id_instansi','id_lokasi']);

        // dd($groupByInstansi[1][3]);
        // $groupByInstansi[id_instansi][id_lokasi];

        foreach ($groupByInstansi as $id_instansi => $instansiA)
        {
            foreach ($instansiA as $id_lokasi => $intansiALokasiB)
            {
                // dd($intansiALokasiB);
                foreach ($intansiALokasiB as $tugas)
                {
                    // $nama_instansi=str_replace(" ","-",$tugas->instansi->nama_instansi);
                    $nama_instansi=$tugas->instansi->nama_instansi;
                    $nama_lokasi=$tugas->lokasi->nama;
                    $nama_komoditas=$tugas->komoditas->nama;

                    $harga=null;
                    $tgl=null;

                    foreach ($tugas->survey->sortBy('counted_at') as $su)
                    {
                        $harga[]= $su->harga;
                        $t=new Carbon($su->counted_at);
                        $tgl[]= $t->format('M-d');//Y H:i
                    }
                    // dd($harga);


                    $chart[$nama_instansi][$nama_lokasi][$nama_komoditas]=new jumlahUser;
                    $chart[$nama_instansi][$nama_lokasi][$nama_komoditas]->labels($tgl);
                    $chart[$nama_instansi][$nama_lokasi][$nama_komoditas]->dataset($nama_komoditas, 'line', $harga)->color('#5f92e3')
                    // ->color($faker->randomElement(['#5f92e3','#4ecca1','#98cc4e','#cc8b4e']))
                    ;

                    // $chart[$nama_lokasi][$nama_komoditas]->setResponsive(true);
                    // $chart[$nama_lokasi][$nama_komoditas]->minimalist(true);
                    // $chart[$nama_lokasi][$nama_komoditas]->displayLegend(true);
                    // $chart[$nama_lokasi][$nama_komoditas]->barWidth(200);
                }
            }

        }



        // dd($chart);
        return $chart;

    }











        // //MENGATUR STRUKTUR ARRAY ELOQUENT
        // foreach ($groupByInstansi as $id_instansi=>$perInstansi)
        // {
        //     //INSTANSI
        //     $nama_instansi=Instansi::find($id_instansi)->nama_instansi;
        //     $groupByInstansiKomoditas[$nama_instansi]=$perInstansi->groupBy('id_komoditas');

        //     foreach ($groupByInstansiKomoditas as $nama_instansi => $perInstansi)
        //     {
        //         //INSTANSI
        //         foreach ($perInstansi as $id_komoditas => $perKomoditas)
        //         {
        //             //KOMODITAS
        //             $nama_komoditas=Komoditas::find($id_komoditas)->nama;
        //             $groupByInstansiKomoditasFix[$nama_instansi][$nama_komoditas]=$perKomoditas;

        //         }
        //     }

        // }

        // // dd($groupByInstansiKomoditasFix);




        // //PEMBUATAN CHART
        // foreach ($groupByInstansiKomoditasFix as $nama_instansi => $perkomoditas)
        // {
        //     foreach ($perkomoditas as $nama_komoditas => $perTugasSurvey)
        //     {
        //         $harga=null;
        //         $tgl=null;

        //         foreach ($perTugasSurvey as $tugas)
        //         {
        //             foreach ($tugas->survey as $su)
        //             {
        //                 $harga[]= $su->harga;
        //                 $tgl[]= $su->counted_at;
        //             }
        //         }

        //         $chart[$nama_instansi][$nama_komoditas]=new jumlahUser;
        //         $chart[$nama_instansi][$nama_komoditas]->labels($tgl);
        //         $chart[$nama_instansi][$nama_komoditas]->dataset($nama_komoditas.' - '.$nama_instansi, 'line', $harga)->color('#5f92e3');

        //         // $chart[$nama_instansi][$nama_komoditas]->setResponsive(true);
        //         // $chart->minimalist(true);
        //         // $chart->displayLegend(true);
        //         // $chart->barWidth(20);

        //     }
        //     // dd();
        // }






}