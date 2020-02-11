<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\jumlahUser;
use App\Models\Instansi;

//Keperluan Test
use App\Models\Komoditas;
use App\Models\Survey;
use App\Models\TugasSurvey;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Traits\chartTrait;


class HomeController extends Controller
{
    use chartTrait;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');
        $survey=[];

        if ( Auth::user()->hasRole('Admin') ) return $this->homeAdmin($week,$survey);
        else if( Auth::user()->hasRole('Supervisor') ) return $this->homeSupervisor($week,$survey);
        else if( Auth::user()->hasRole('Surveyor') ) return $this->homeSurveyor($week,$survey);

    }



    public function homeAdmin($week,$survey)
    {
        $taskPerKomoditas=TugasSurvey::with(['instansi','komoditas','lokasi','survey'])
        ->whereHas('survey', function ($query) use($week)
        {
            return $query->where('counted_at', '>=', $week)//minggu ini
            // ->where('valid', 1)//yg valid
            ->orderBy('counted_at','DESC')
            ;
        })
        ->where('id_instansi', 1)
        ->orderBy('id_instansi','ASC')
        ->distinct()
        ->get()

        ->groupBy('id_komoditas')
        // ->dd()
        ;

        // dd($taskPerKomoditas);


        //setelah diurutkan dan grup per komoditas, kemudian
        //memecah dan mengambil data pertama (paling tinggi tanggal)..
        foreach ($taskPerKomoditas as $key => $arrayKomoditasX)
        {
            // $arrayKomoditasX->whereHas('survey',function($query){
            //     $query->orderBy('counted_at');
            // });

            // if($key==17)dd($arrayKomoditasX);

            // foreach ($arrayKomoditasX as $task)
            // {
            //     // dd($task);
            //     // $survey[]=$task->survey->sortBy('counted_at')->first();//tda perlu so ada di orderBy
            //     $survey[]=$task;
            // }

            $survey[]=$arrayKomoditasX[0];

            // $survey[]=$taskAtKom;

        }

        // dd($survey);

        // dd($taskPerKomoditas);

        return view('dashboardAdmin',compact(['survey']));
    }


    public function homeSupervisor($week,$survey)
    {


        $taskPerKomoditas=TugasSurvey::with(['instansi','komoditas','lokasi','survey'])
        ->whereHas('survey', function ($query) use($week)
        {
            return $query
            ->where('counted_at', '>=', $week)//minggu ini
            // ->where('valid', 1)//yg valid
            ->orderBy('counted_at','DESC')
            ;
        })
        ->where('id_instansi', Auth::user()->id_instansi)
        ->get()

        ->groupBy('id_komoditas')
        // ->dd()
        ;

        //setelah diurutkan dan grup per komoditas, kemudian
        //memecah dan mengambil data pertama (paling tinggi tanggal)..
        foreach ($taskPerKomoditas as $key => $arrayKomoditasX)
        {
            $isisurvey[]=$arrayKomoditasX[0];
        }

        //------------------------------------------------------------------------------------
        // batas,    ini untuk counter
        //------------------------------------------------------------------------------------


        $tgs=TugasSurvey::with(['komoditas'])
        // ->whereHas('tugas',function ($query) {
        //     $query
        //     // ->where('id_lokasi', 3 )
        //     ;
        // })
        ->where('id_instansi', Auth::user()->id_instansi )
        ->orderBy('id_lokasi','ASC')

        ->get()
        // ->dd();
        ;
        $tugas=$tgs->groupBy('id_lokasi');
        $jumlahTugas=$tgs->count();


        // ada masalah di surveyor kalau survey pas2 hari senin dia tdk bisa baca
        // $surveyPerKomoditas=Survey::with(['user','instansi','komoditas'])
        // ->where('counted_at', '>=', $week)
        // ->where('id_instansi', Auth::user()->id_instansi)
        // ->where('id_user', Auth::user()->id)
        // ->orderBy('id_instansi','ASC')
        // ->orderBy('counted_at','DESC')
        // ->distinct()
        // ->get();

        $surveyPerKomoditas=Survey::with('tugas.instansi')
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

        ->groupBy('id_tugas_survey')
        // ->dd()
        ;

        //jumlah grup id_tugas_survey yang terbentuk merupakan jumlah di survey
        $jumlahDisurvey=$surveyPerKomoditas->keys()->count();


        // dd($surveyPerKomoditas->keys()->count());
        // dd(array_keys($surveyPerKomoditas->toArray()));

        // dd($surveyPerKomoditas->toArray());
        // dd($week);

        // foreach ($surveyPerKomoditas as $key => $nilai)
        // {
        //     $survey[]=$nilai->sortBy('counted_at')->first();
        //     $id_komoditas[]=$key;
        // }


        // dd($id_komoditas);



        // $chart=$this->chartUser();
        return view('dashboardSupervisor',compact(['tugas','jumlahTugas','jumlahDisurvey','survey','isisurvey']));
    }


    public function homeSurveyor($week,$survey)
    {
        // echo"<a href='http://ewsbi.kongkong.web.id/survey/chart'>Klik</a> <br><br>";
        // dd('sedang maintenance');


        $komo=Komoditas::
        whereHas('tugas'. function ($query){
            $query->where('id_instansi', auth::user()->id_instansi)->get();
        });
        $komoditas=$komo->split(3);
        $jumlahKomoditas=$komo->count();
        dd($komoditas);


        // ada masalah di surveyor kalau survey pas2 hari senin dia tdk bisa baca

        $surveyPerKomoditas=Survey::with(['user','instansi','komoditas'])
        ->where('counted_at', '>=', $week)
        ->where('id_instansi', Auth::user()->id_instansi)
        ->where('id_user', Auth::user()->id)
        ->orderBy('id_instansi','ASC')
        ->orderBy('counted_at','DESC')
        ->distinct()
        ->get()

        ->groupBy('id_komoditas')
        ;
        // dd($surveyPerKomoditas->toArray());
        // dd($week);

        foreach ($surveyPerKomoditas as $key => $nilai)
        {
            $survey[]=$nilai->sortBy('counted_at')->first();
            $id_komoditas[]=$key;
        }

        $jumlahDisurvey=count($survey);

        // dd($id_komoditas);



        // $chart=$this->chartUser();
        return view('dashboardSurveyor',compact(['komoditas','jumlahKomoditas','jumlahDisurvey','survey']));
    }



    public function test(Faker $faker)
    {
        $komoditas=Komoditas::with(['instansi'])->where('id',4)->get();
        dd($komoditas[0]->instansi[0]->tugaspivot);
        // dd(Komoditas::find(1));

        // $a=Survey::with('komoditas')->whereHas('komoditas',function($q){

        //     $q->where('lokasi','Pasar Senin')
        //     // ->whereHas('instansi',function($q2){
        //     //     $q2->where('nama_instansi', 'Bapppeda');
        //     // })
        //     ;

        // })
        // ->where('id_instansi',1)
        // ->get();


        // dd($a);

        // for ($i=0; $i < 4; $i++)
        // {
        //     $survey=new Survey;
        //     $survey->id_user = $faker->randomElement(['3','4','5']);
        //     $user=User::find($survey->id_user);

        //     do {
        //         $komoditas=Komoditas::find($faker->randomElement(['1','2','3','4','5','6','7','8']));
        //         // dd($komoditas->id_instansi);
        //     }
        //     while( $komoditas->id_instansi != $user->id_instansi );

        //     $survey->id_komoditas = $komoditas->id;

        //     dd([$komoditas->id_instansi,$user]);

        //     $survey->harga = "50000";
        //     $survey->counted_at = Carbon::now();
        //     $survey->valid = 0;
        //     $survey->save();
        // }



    }
}
