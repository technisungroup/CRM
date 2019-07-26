<?php

namespace App\Http\Controllers\superadmin;

use App\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $modules = '';
    public function __construct(){

        $this->modules = true;
        View::share('modulesLink',$this->modules);
    }
    public function index()
    {
        $data = Module::all();
        return view('settings.modules.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.modules.add-edit');
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
                return redirect('superadmin/modules/create')->withErrors($validator)->withInput();
            }
            $module = new Module();
            $module->title = $inputs['title'];
            $module->save();
            $request->session()->flash('success','new module successfully created');
            return redirect('superadmin/modules');
        }catch (Exception $e){
            return redirect('superadmin/modules/create')->withErrors($e->getMessage());
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
        $data = Module::find($id);
        return view('settings.modules.add-edit',compact('data'));
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
                return redirect('superadmin/modules/'.$id.'/edit')->withErrors($validator)->withInput();
            }
            $module = Module::find($id);
            $module->title = $inputs['title'];
            $module->save();
            $request->session()->flash('success','module successfully updated');
            return redirect('superadmin/modules');
        }catch (Exception $e){
            return redirect('superadmin/modules/create')->withErrors($e->getMessage());
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
        $module = Module::find($id);
        $module->delete();
        $request->session()->flash('success','module successfully deleted');
        return redirect('superadmin/modules');
    }
}
