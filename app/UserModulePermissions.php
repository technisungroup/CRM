<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModulePermissions extends Model
{
    protected $table = 'user_module_permissions';

    function modules(){

        return $this->hasOne('App\Module','id','module_id');
    }
    function permissions(){

        return $this->hasOne('App\Permission','id','permission_id');
    }
}
