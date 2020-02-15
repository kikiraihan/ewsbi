<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'id_user',
        'id_tugas_survey',
        'harga',
        'merek',
        'valid',
        'counted_at',
        'kenaikan',
        'komentar',
    ];


    public function tugas(){
        return $this->belongsTo('App\Models\TugasSurvey', 'id_tugas_survey');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user');//pasti ada
    }

    // public function instansi(){
    //     $query
    //         ->with(['tugas_survey'])
    //         ->a
    //         ;
    // }

    // public function komoditas(){

    // }

    // public function lokasi(){

    // }


    //SCOPE
    public function scopeOnlyValidThisWeek($query,$week)
    {
        return $query
            ->where('valid',1)
            ->where('counted_at', '>=', $week)
            ->orderBy('counted_at','ASC')
            ;
    }

    public function scopeOnlyNotValidThisWeek($query,$week)
    {
        return $query
            ->where('valid',0)
            ->where('counted_at', '>=', $week)
            ->orderBy('counted_at','ASC')
            ;
    }

    public function scopeOnlyNotValidNotThisWeek($query,$week)
    {
        return $query
            ->where('valid',0)
            ->where('counted_at', '<', $week)
            ->orderBy('counted_at','ASC')
            ;
    }

    public function scopePerInstansi($query,$user)
    {
        //whereHas,Has mengembalikan query.
        //contains mengembalikan boolean.
        //$q yg di pass berarti mengambil objek parent dari parent itu sendiri,
        //sehingga seperti menambah skrip ke dalam parent.


        // $perkomoditas->distinct('counted_at');
        // dd($perkomoditas->uniq('counted_at'));

        // $jobs = Job::search();
        // $countries = $jobs->get()->map(function( $job ) {
        //     return $job->country;
        // });
        // $countries = array_unique( $countries->toArray() );



        return $query
            ->with(['users'])
            ->whereHas('users',function($q) use($user)
            {
                $q
                ->where('users.id_instansi',$user);
            });
    }

    public function scopeWhereNamaInOrmawaMahasiswa($query,$cari)
    {
        //whereHas,Has mengembalikan query.
        //contains mengembalikan boolean.
        //$q yg di pass berarti mengambil objek parent dari parent itu sendiri,
        //sehingga seperti menambah skrip ke dalam parent.

        return $query
            ->with(['ormawa','mahasiswa'])
            ->whereHas('ormawa',function($q) use($cari){
                $q
                ->where('nama', 'like', '%'.$cari.'%');
            })
            ->orWhereHas('mahasiswa',function($q) use($cari){
                $q
                ->where('nama', 'like', '%'.$cari.'%')
                ->orWhere('prodi', 'like', '%'.$cari.'%')
                ;
            });
            //user yang berelasi ormawa dan mahasiswa, dan memiliki nama $cari di masing2 model
    }

}
