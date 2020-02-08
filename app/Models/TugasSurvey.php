<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TugasSurvey extends Model
{

    protected $fillable = [
        'id_komoditas',
        'id_lokasi',
        'id_instansi',
    ];

    public function instansi()
    {
        return $this->belongsTo('App\Models\Instansi', 'id_instansi');
    }

    public function komoditas()
    {
        return $this->belongsTo('App\Models\Komoditas', 'id_komoditas');
    }

    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi', 'id_lokasi');
    }

    public function survey()
    {
        return $this->hasMany('App\Models\Survey', 'id_tugas_survey');
    }









    // relasi tapi di filter hasilnya
    public function surveyvalidthisweek()
    {
        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');

        return $this->hasMany('App\Models\Survey', 'id_tugas_survey')
        ->OnlyValidThisWeek($week)
        ;
    }

    public function surveynotvalidthisweek()
    {
        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');

        return $this->hasMany('App\Models\Survey', 'id_tugas_survey')
        ->OnlyNotValidThisWeek($week)
        ;
    }

    public function surveynotvalidnotthisweek()
    {
        $week=Carbon::now()->startOfWeek()->format('Y-m-d H:i');

        return $this->hasMany('App\Models\Survey', 'id_tugas_survey')
        ->OnlyNotValidNotThisWeek($week)
        ;
    }

    public function surveytakeone()
    {
        return $this->hasMany('App\Models\Survey', 'id_tugas_survey')
        ->orderBy('counted_at','ASC')
        ->take(1);
    }













}
