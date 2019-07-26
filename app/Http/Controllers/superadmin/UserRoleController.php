<?php

namespace App\Http\Controllers\superadmin;

use App\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $roleType = '';
    public function __construct(){

        $this->roleType = true;
        View::share('roleTypeLink',$this->roleType);
    }

    public function index()
    {
        $data = UserRole::all();
        return view('settings.user_role.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.user_role.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'title' => 'required|string|max:150',
            ]);
            if ($validator->fails()) {
                return redirect('superadmin/user-role/create')->withErrors($validator)->withInput();
            }
            $role = new UserRole();
            $role->title = $inputs['title'];
            $role->save();
            $request->session()->flash('success', 'new role successfully added');
            return redirect('superadmin/user-role');
        }catch (Exception $e){
            return redirect('superadmin/user-role')->withErrors($e)->withInput();
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
    public function edit($id){

        $data = UserRole::find($id);
        return view('settings.user_role.add-edit',compact('data'));
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
                'title' => 'required|string|max:150',
            ]);
            if ($validator->fails()) {
                return redirect('superadmin/user-role/'.$id.'/edit')->withErrors($validator)->withInput();
            }
            $role = UserRole::find($id);
            $role->title = $inputs['title'];
            $role->save();
            $request->session()->flash('success', 'role successfully updated');
            return redirect('superadmin/user-role');
        }catch (Exception $e){
            return redirect('superadmin/user-role')->withErrors($e)->withInput();
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
        $role = UserRole::find($id);
        $role->delete();
        $request->session()->flash('success', 'role successfully deleted');
        return redirect('superadmin/user-role');
    }
}
