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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function() {
    if(Auth::guest()){
        return redirect(route('login'));
    } else {
        return redirect(route('main'));
    }

})->name('home');
Route::get('/main', 'MainController@index')->name('main');

//Users
Route::get('/users/new', 'UserController@register')->name('register');
Route::post('/users', 'UserController@store')->name('user.store');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//Vehicles
Route::get('/vehicles', 'VehicleController@index')->name('vehicles.index');
Route::get('/vehicles/new', 'VehicleController@create')->name('vehicle.new');
Route::post('/vehicles','VehicleController@store')->name('vehicle.store');
//Routes
Route::get('/routes/new', 'RouteController@create')->name('routes.new');
Route::post('/routes', 'RouteController@store')->name('routes.store');
//Maintenances
Route::get('/maintenances/new', 'MaintenanceController@create')->name('maintenances.new');
Route::get('/maintenances/calendar', 'MaintenanceController@calendar')->name('maintenances.calendar');
Route::post('/maintenances', 'MaintenanceController@store')->name('maintenances.store');
Route::get('/maintenances/getData', 'MaintenanceController@getData');
