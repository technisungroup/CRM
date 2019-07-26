<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    function getUserData(){
        return $this->where(['user_type' => '3'])->with('branch')->with('userRole')->withTrashed()->get();
    }

    function branch(){
        return $this->hasOne('App\Location','id','user_location_id');
    }
    function userRole(){
        return $this->hasOne('App\UserRole','id','user_location_id');
    }
    function userPermissions(){
        return $this->hasMany('App\UserModulePermissions','user_id','id');
    }
}
