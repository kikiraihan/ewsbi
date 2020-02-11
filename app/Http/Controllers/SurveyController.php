<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\TugasSurvey;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\chartTrait;
use Illuminate\Support\Carbon;

class SurveyController extends Controller
{
    use chartTrait;
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');
        // dd($week);


        $task=TugasSurvey::with('survey.user','lokasi','komoditas','instansi')
        ->whereHas('survey',function ($query) use($week){
            $query
            ->where('valid',1)
            ->where('counted_at', '>=', $week)
            ->orderBy('counted_at','ASC')
            ;
        })
        ->orderBy('id_lokasi','ASC')
        ->get()
        ->groupBy('id_instansi')
        ;
        // dd($task['1'][0]);

        // $columns = Survey::first()->getFillable();
        $waktu=Carbon::now()->locale('in');



        return view('survey.index-admin',compact(['task','waktu']));

    }




    public function mylist()
    {
        echo"<a href='http://ewsbi.kongkong.web.id/survey/chart'>Klik</a> <br><br>";
        dd('sedang maintenance');

        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');

        $survey=Survey::with(['user','instansi','komoditas'])
        ->where('id_user', Auth::user()->id )
        ->orderBy('counted_at','ASC')
        ->get()
        // ->groupBy('id_komoditas')
        ;

        $columns = Survey::first()->getFillable();
        $waktu=Carbon::now()->locale('in');

        return view('survey.list-surveyor',compact(['survey','columns','waktu']));
    }









    public function aproval()
    {
        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');
        // dd($week);



        // $tugas_baru=TugasSurvey::with('surveynotvalidthisweek.user','lokasi','komoditas','instansi')
        // ->whereHas('survey',function ($query) use($week){
        //     $query
        //     ->where('valid',0)
        //     ->where('counted_at', '>=', $week)
        //     ->orderBy('counted_at','ASC')
        //     ;
        // })
        // ->where('id_instansi', Auth::user()->id_instansi )
        // ->get()
        // ;

        // $collection = collect();
        // foreach ($tugas_baru as $pecah)
        // {
        //     $collection->push($pecah->surveynotvalidthisweek);
        // }

        // // dd($collection->collapse()[0]->tugas->komoditas->nama);


        $survey_valid=Survey::with('tugas.instansi')
        ->whereHas('tugas',function ($query) use($week){
            $query
            ->where('id_instansi', Auth::user()->id_instansi )
            // ->orderBy('id_lokasi','ASC')
            ;
        })
        ->where('valid',1)
        ->where('counted_at', '>=', $week)
        ->orderBy('counted_at','ASC')
        ->get()
        // ->dd()
        ;

        $survey_baru=Survey::with('tugas.instansi')
        ->whereHas('tugas',function ($query) use($week){
            $query
            ->where('id_instansi', Auth::user()->id_instansi )
            // ->orderBy('id_lokasi','ASC')
            ;
        })
        ->where('valid',0)
        ->where('counted_at', '>=', $week)
        ->orderBy('counted_at','ASC')
        ->get()
        ->sortBy(function ($product, $key) {
            return $product->tugas->id_lokasi;
        });
        // ->dd()
        ;


        $survey_expired=Survey::with('tugas.instansi')
        ->whereHas('tugas',function ($query) use($week){
            $query
            ->where('id_instansi', Auth::user()->id_instansi )
            // ->orderBy('id_lokasi','ASC')
            ;
        })
        ->where('valid',0)
        ->where('counted_at', '<', $week)
        ->orderBy('counted_at','ASC')
        ->get()
        // ->dd()
        ;

        $waktu=Carbon::now()->locale('in');

        return view('survey.list-supervisor',compact(['survey_baru','survey_valid','survey_expired','waktu']));

    }

    public function unaprove($id)
    {
        $survey=Survey::find($id);
        $survey->valid=0;
        $survey->save();
        return redirect()->route('survey.aproval');
    }

    public function aprove($id)
    {
        $survey=Survey::find($id);

        // dd($survey->tugas->id_instansi);


        $cek=Survey::with('tugas')
        ->whereHas('tugas', function ($query) use($survey){
            $query
            ->where('id_instansi', $survey->tugas->id_instansi)
            ->where('id_komoditas', $survey->tugas->id_komoditas)
            // // ->where('id_tugas_survey', $survey->tugas->id_tugas_survey)
            ;
        })
        ->where('valid', 1)
        ->count()
        ;

        // dd($cek);

        if ($cek <= 0) {
            $survey->valid=1;
            $survey->save();
            return redirect()->route('survey.aproval');
        }
        else{
            return redirect()->route('survey.aproval')->with('message', 'Komoditas sejenis telah ada, silahkan batalkan sebelumnya!');
        }

    }

    public function kosongkan()
    {
        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');


        $survey_expired=Survey::with('tugas.instansi')
        ->whereHas('tugas',function ($query) use($week){
            $query
            ->where('id_instansi', Auth::user()->id_instansi )
            ;
        })
        ->where('valid',0)
        ->where('counted_at', '<', $week)
        ->delete()
        ;

        return redirect()->route('survey.aproval');
    }






    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        // dd($id.' Akan dihapus');
        $survey=Survey::find($id);
        $survey->delete();

        if (Auth::user()->hasRole('Admin'))
        return redirect()->route('survey');
        else if (Auth::user()->hasRole('Supervisor'))
        return redirect()->route('survey.aproval');
        else if (Auth::user()->hasRole('Surveyor'))
        return redirect()->route('survey.mylist');
    }










    public function surveyChart()
    {
        if ( Auth::user()->hasRole('Admin') )
        {
            $chart=$this->chartAdmin();
            return view('survey.chart-admin',compact(['chart']));
        }

        else if( Auth::user()->hasRole('Supervisor') OR Auth::user()->hasRole('Surveyor') )
        {
            $chart=$this->chartUser();
            return view('survey.chart-user',compact(['chart']));
        }

    }






}
