<?php

namespace App\Http\Controllers\superadmin;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $locationlink = '';
    public function __construct(){
        $this->locationslink = true;
        View::share('locationLink',$this->locationslink);
    }

    public function index(){

        $data = Location::all();
        return view('settings.locations.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('settings.locations.add-edit');
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
                return redirect('superadmin/locations/create')->withInput()->withErrors($validator);
            }
            $location = new Location();
            $location->title = $inputs['title'];
            $location->save();

            $request->session()->flash('success', 'new location successfully created');
            return redirect('superadmin/locations');
        }catch (Exception $e){
            return redirect('superadmin/locations/create')->withInput()->withErrors($validator);
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

        $data = Location::find($id);
        return view('settings.locations.add-edit',compact('data'));
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
                return redirect('superadmin/locations/'.$id.'/edit')->withInput()->withErrors($validator);
            }
            $location = Location::find($id);
            $location->title = $inputs['title'];
            $location->save();

            $request->session()->flash('success', 'location successfully updated');
            return redirect('superadmin/locations');
        }catch (Exception $e){
            return redirect('superadmin/locations/create')->withInput()->withErrors($validator);
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
        $location = Location::find($id);
        $location->delete();
        $request->session()->flash('success', 'location successfully deleted');
        return redirect('superadmin/locations');
    }
}