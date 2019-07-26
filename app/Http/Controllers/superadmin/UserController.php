<?php

namespace App\Http\Controllers\superadmin;

use App\Location;
use App\Module;
use App\Permission;
use App\User;
use App\UserModulePermissions;
use App\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $users = '';
    public function __construct(){

        $this->users = true;
        View::share('usersLink',$this->users);
    }
    public function index(){

        $data = (new User())->getUserData();
        return view('settings.users.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $modules = (new Module())->get();
        $userRoles = (new UserRole())->get();
        $locations = (new Location())->get();
        $permissions = Permission::all();
        return view('settings.users.add-edit',compact('modules','userRoles','locations','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'username' => 'required|string|max:150',
                'first_name' => 'required|string|max:150',
                'last_name' => 'required|string|max:150',
                'email' => 'required|email|unique:users|max:150',
                'phone' => 'required|max:14|regex:/(^[0-9 .\-+]+$)+/',
                'user_role' => 'required|numeric',
                'branch' => 'required|numeric',
                'modules.*' => 'required',
                'permissions' => 'required',
                'password' => 'required|string|max:20|min:6|same:confirm_password',
            ]);
            if ($validator->fails()) {
                return redirect('superadmin/users/create')->withInput()->withErrors($validator);
            }
            DB::beginTransaction();
            $user = new User();
            $user->name             = $inputs['username'];
            $user->first_name       = $inputs['first_name'];
            $user->last_name        = $inputs['last_name'];
            $user->email            = $inputs['email'];
            $user->phone            = $inputs['phone'];
            $user->user_role        = $inputs['user_role'];
            $user->user_location_id = $inputs['branch'];
            $user->password         = Hash::make($inputs['password']);
            $user->save();
            $moduePermissions = [];
            foreach($inputs['modules'] as $module) {

                foreach ($inputs['permissions'][$module] as $key => $permissions) {

                    $moduePermissions[] = [

                        'module_id' => $module,
                        'user_id' => $user->id,
                        'permission_id' => $permissions,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
            }
            if(!empty($moduePermissions)){
                (new UserModulePermissions())->insert($moduePermissions);
            }
            DB::commit();
            $request->session()->flash('success','new user successfully created');
            return redirect('superadmin/users');
        }catch (Exception $e){
            DB::rollBack();
            return redirect('superadmin/users/create')->withInput()->withErrors($e->getMessage());
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modules = (new Module())->get();
        $userRoles = (new UserRole())->get();
        $locations = (new Location())->get();
        $permissions = Permission::all();
        $data = User::with('userPermissions')->find($id);//pr($data->toArray());
        $selectedModules = [];
        if(!$data->userPermissions->isEmpty()){
            foreach($data->userPermissions as $module){
                $selectedModules['modules'][$module['module_id']] = $module['module_id'];
            }
        }
        //pr($selectedModules['modules'],1);
        return view('settings.users.add-edit',compact('modules','userRoles','locations','permissions','data','selectedModules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $inputs = $request->all();
            $validator = Validator::make($inputs, [

                'username' => 'required|string|max:150',
                'first_name' => 'required|string|max:150',
                'last_name' => 'required|string|max:150',
                'email' => 'required|email|max:150',
                'phone' => 'required|max:18|regex:/(^[0-9 .\-+]+$)+/',
                'user_role' => 'required|numeric',
                'branch' => 'required|numeric',
                'modules.*' => 'required',
                'permissions' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('superadmin/users/'.$id.'edit')->withInput()->withErrors($validator);
            }
            DB::beginTransaction();
            $user = User::find($id);
            $user->name             = $inputs['username'];
            $user->first_name       = $inputs['first_name'];
            $user->last_name        = $inputs['last_name'];
            $user->email            = $inputs['email'];
            $user->phone            = $inputs['phone'];
            $user->user_role        = $inputs['user_role'];
            $user->user_location_id = $inputs['branch'];
            $user->save();
            $moduePermissions = [];
            (new UserModulePermissions())->where(['user_id' => $id])->delete();
            foreach($inputs['modules'] as $module) {

                foreach ($inputs['permissions'][$module] as $key => $permissions) {

                    $moduePermissions[] = [

                        'module_id' => $module,
                        'user_id' => $user->id,
                        'permission_id' => $permissions,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
            }
            if(!empty($moduePermissions)){
                (new UserModulePermissions())->insert($moduePermissions);
            }
            DB::commit();
            $request->session()->flash('success','user successfully updated');
            return redirect('superadmin/users');
        }catch (Exception $e){
            DB::rollBack();
            return redirect('superadmin/users/create')->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::find($id);
        $user->delete();
        $request->session()->flash('success','user '.$user->name.' successfully deactivated');
        return redirect('superadmin/users');
    }

    public function inActiveUser(Request $request,$id){

        $user = User::withTrashed()->find($id)->restore();
        $request->session()->flash('success','user successfully Activated');
        return redirect('superadmin/users');
    }

    public function checkUserPermissions($id){

        $data = UserModulePermissions::where(['user_id' => $id])->with('modules')->with('permissions')->get();
        $dataArray = [];
        foreach($data as $dt){

            $dataArray[$dt->module_id]['module_id'] = $dt->module_id;
            $dataArray[$dt->module_id]['module'] = $dt->modules->title;
            $dataArray[$dt->module_id]['permissions'][] = [

                'permission_id' => $dt->permission_id,
                'permission'    => $dt->permissions->title,
            ];
        }
        //pr($dataArray);
        //pr($data->toArray(),1);
        return view('settings.users.check-permissions',compact('dataArray'));
    }
}