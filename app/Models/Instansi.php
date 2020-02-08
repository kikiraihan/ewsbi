<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $fillable = [
        'nama_instansi',
        'alamat'
    ];

    public function user(){
        return $this->hasMany('App\Models\User','id_instansi');//boleh null
    }




    public function komoditas(){
        return $this
        ->belongsToMany('App\Models\Komoditas', 'tugas_surveys', 'id_instansi', 'id_komoditas')
        // ->using('App\Models\TugasSurvey')
        ->withPivot([
            'id','created_at'
        ])
        ->withTimestamps()
        ->as('tugaspivot')
        ;
    }

    public function lokasi(){
        return $this
        ->belongsToMany('App\Models\Lokasi', 'tugas_surveys', 'id_instansi', 'id_lokasi')
        // ->using('App\Models\TugasSurvey')
        ->withPivot([
            'id','created_at'
        ])
        ->withTimestamps()
        ->as('tugaspivot')
        ;
    }

    public function tugas(){ //TugasSurvey
        return $this->hasMany('App\Models\TugasSurvey', 'id_instansi');//pasti ada
    }

    public function survey()
    {
        return $this->hasManyThrough(
            'App\Models\Survey',
            'App\Models\TugasSurvey',
            'id_instansi',
            'id_tugas_survey'
        );
    }

}
