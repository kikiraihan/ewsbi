<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Mail\NotifKenaikan;
use App\Models\Komoditas;
use App\Models\Survey;
use App\Models\TugasSurvey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            ->orderBy('counted_at','DESC')
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

        // echo"<a href='http://ewsbi.kongkong.web.id/survey/chart'>Klik</a> <br><br>";
        // dd('sedang maintenance');

        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');

        //minggu ini
        $survey=Survey::with(['user','tugas'])
        ->where('counted_at', '>=', $week)
        ->where('id_user', Auth::user()->id )
        // ->where('valid', 0 )
        ->orderBy('counted_at','DESC')
        ->get()
        ;

        // terdahulu
        $surveyTerdahulu=Survey::with(['user','tugas'])
        ->where('counted_at', '<', $week)
        ->where('id_user', Auth::user()->id )
        // ->where('valid', 0 )
        ->orderBy('counted_at','DESC')
        ->get()
        ;


        $columns = Survey::first()->getFillable();
        // dd($columns);
        $waktu=Carbon::now()->locale('in');


        $tugas=TugasSurvey::with(['instansi','lokasi','komoditas'])
            ->where('id_instansi', Auth::user()->id_instansi)
            ->orderBy('id_lokasi')
            ->get()
            // ->groupBy('id_lokasi')
            // ->dd()
            ;


        $lokasi=Lokasi::all(['nama','id']);
        $komoditas=Komoditas::all(['nama','id']);

        return view('survey.list-surveyor',compact(['survey','columns','waktu','lokasi','komoditas','tugas','surveyTerdahulu']));
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
        ->orderBy('counted_at','DESC')
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
        ->orderBy('counted_at','DESC')
        ->get()
        ->sortBy(function ($product, $key) {
            return $product->tugas->id_lokasi;
        })
        // ->sortBy(function ($product, $key) {
        //     return $product->tugas->id_komoditas;
        // });
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
        ->orderBy('counted_at','DESC')
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

            //kirim email ke semua lain, jika naik
            if ($survey->kenaikan=='naik')
            {
                $user=User::where('id_instansi', "!=", Auth::user()->id_instansi)->get(['email']);
                foreach ($user as $u)
                Mail::to($u->email)->send(new NotifKenaikan($survey));
            }

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

    public function store(Request $request)
    {
        // dd($request->all());


        //validasi
        $CustomMessages = [
            'number' => 'Kolom :attribute, harus berupa angka',
            'string' => 'Kolom :attribute, harus berupa angka',
            'required'=>'Kolom :attribute tidak boleh kosong',
        ];

        $this->validate($request, [
            'id_tugas_survey'=>"required|string",
            'harga'=>"required|string",
            'merek'=>"required|string",
            'komentar'=>"required|string",
        ],$CustomMessages);

        // dd('valid');

        //--------- dari form
        //id_tugas_survey
        //harga
        //merek
        //komentar

        //--------- generate
        //id_user
        //id
        //valid
        //kenaikan
        //counted_at

        //created_at
        //update_at

        $survey= new Survey;
        $survey->id_tugas_survey=$request->id_tugas_survey;
        $survey->harga=$request->harga;
        $survey->merek=$request->merek;
        $survey->komentar=$request->komentar;

        $survey->id_user=$request->user()->id;
        $survey->valid=0;
        $survey->counted_at = Carbon::now();




        //jika survey sebelumnya < survey sekarang, maka naik
        //jika survey sebelumnya > survey sekarang, maka turun
        //jika survey sebelumnya = survey sekarang, stabil
        if($survey->tugas->surveysterakhir->isEmpty())
        {
            $survey->kenaikan="stabil";
        }
        else
        {
            if($survey->tugas->surveysterakhir->first()->harga < $request->harga) $survey->kenaikan="naik";
            elseif($survey->tugas->surveysterakhir->first()->harga > $request->harga) $survey->kenaikan="turun";
            elseif($survey->tugas->surveysterakhir->first()->harga = $request->harga) $survey->kenaikan="stabil";
        }

        $survey->save();

        return redirect()->route('survey.mylist');
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





    public function edit($id)
    {
        $survey=Survey::find($id);
        $columns = $survey->getFillable();
        unset($columns[0],$columns[4],$columns[5],$columns[6]);

        // dd($survey->tugas->komoditas->nama);
        // dd();
        // 1 => "id_tugas_survey"
        // 2 => "harga"
        // 3 => "merek"
        // 7 => "komentar"


        // 0 => "id_user"


        // 4 => "valid"
        // 5 => "counted_at"
        // 6 => "kenaikan"

        return view('survey.edit',compact(['survey','columns']));
    }


    public function update(Request $request, $id)
    {


        //validasi
        $CustomMessages = [
            'number' => 'Kolom :attribute, harus berupa angka',
            'string' => 'Kolom :attribute, harus berupa angka',
            'required'=>'Kolom :attribute tidak boleh kosong',
        ];

        $this->validate($request, [
            'harga'=>"required|string",
            'merek'=>"required|string",
            'komentar'=>"required|string",
        ], $CustomMessages);

        //simpan
        $survey= Survey::find($id);

        $survey->harga=$request->harga;
        $survey->merek=$request->merek;
        $survey->komentar=$request->komentar;


        //jika survey sebelumnya < survey sekarang, maka naik
        //jika survey sebelumnya > survey sekarang, maka turun
        //jika survey sebelumnya = survey sekarang, stabil
        if($survey->tugas->surveysterakhir->isEmpty())
        {
            $survey->kenaikan="stabil";
        }
        else
        {
            if($survey->tugas->surveysterakhir->first()->harga < $request->harga) $survey->kenaikan="naik";
            elseif($survey->tugas->surveysterakhir->first()->harga > $request->harga) $survey->kenaikan="turun";
            elseif($survey->tugas->surveysterakhir->first()->harga = $request->harga) $survey->kenaikan="stabil";
        }

        $survey->save();

        return redirect()->route('survey.mylist');
    }







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
