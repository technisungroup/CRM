<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::group(['middleware' => ['auth']],function (){

    Route::group(['middleware' => ['superAdmin']],function () {

        Route::resource('superadmin/modules', 'superadmin\ModuleController');
        Route::resource('superadmin/user-role', 'superadmin\UserRoleController');
        Route::resource('superadmin/locations', 'superadmin\LocationController');
        Route::resource('superadmin/users', 'superadmin\UserController');
        Route::get('user-inactive/{id}', 'superadmin\UserController@inActiveUser')->name('user-inactive');
        Route::get('user-permissions/{id}', 'superadmin\UserController@checkUserPermissions')->name('user-permissions');
        Route::resource('superadmin/companies', 'superadmin\CompanyController');
        Route::get('/home', 'HomeController@index')->name('home');
    });

    Route::group(['middleware' => ['users']],function () {

        Route::get('user-profile', 'crm\ProfileController@userDetail')->name('user-profile');
    });
});