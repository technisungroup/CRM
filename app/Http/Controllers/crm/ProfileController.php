<?php

namespace App\Http\Controllers\crm;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function userDetail(){

        $data = User::with('userPermissions')->find(Auth::user()->id);

        $dataArray = [];
        foreach($data->userPermissions as $dt){

            $dataArray[$dt->module_id]['module_id'] = $dt->module_id;
            $dataArray[$dt->module_id]['module'] = $dt->modules->title;
            $dataArray[$dt->module_id]['permissions'][] = [

                'permission_id' => $dt->permission_id,
                'permission'    => $dt->permissions->title,
            ];
        }//pr($dataArray,1);
        return view('crm.profile.profile',compact('data','dataArray'));
    }
}
