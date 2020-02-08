<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'satuan',
    ];


    public function instansi(){
        return $this
        ->belongsToMany('App\Models\Instansi', 'tugas_surveys', 'id_komoditas', 'id_instansi')
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
            'id_komoditas',
            'id_tugas_survey'
        );
    }

}
