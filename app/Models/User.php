<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','id_instansi','kategori', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //accessor dan mutator
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] =  bcrypt($password);

    }


    public function instansi(){
        return $this->belongsTo('App\Models\Instansi', 'id_instansi');//pasti ada
    }

    public function survey(){
        return $this->hasMany('App\Models\Survey', 'id_user');//pasti ada
    }




}
