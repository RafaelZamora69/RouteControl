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
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//Users
Route::get('/users/new', 'UserController@register')->name('register');
Route::get('/users/index', 'UserController@index')->name('user.index');
Route::get('/users/{user}', 'UserController@show')->name('user.show');
Route::get('/users/{user}/edit', 'UserController@edit')->name('user.edit');
Route::put('/users/{user}', 'UserController@update')->name('user.update');
Route::delete('/users/{user}', 'UserController@delete')->name('user.delete');
Route::post('/users', 'UserController@store')->name('user.store');
//Vehicles
Route::get('/vehicles/new', 'VehicleController@create')->name('vehicle.new');
Route::get('/vehicles/index', 'VehicleController@index')->name('vehicles.index');
Route::get('/vehicles/{vehicle}', 'VehicleController@show')->name('vehicle.show');
Route::get('/vehicles/{vehicle}/edit', 'VehicleController@edit')->name('vehicle.edit');
Route::put('/vehicles/{vehicle}', 'VehicleController@update')->name('vehicle.update');
Route::delete('/vehicles/{vehicle}', 'VehicleController@delete')->name('vehicle.delete');
Route::post('/vehicles','VehicleController@store')->name('vehicle.store');
//Routes
Route::get('/routes/new', 'RouteController@create')->name('routes.new');
Route::get('/routes/index', 'RouteController@index')->name('routes.index');
Route::get('/routes/{route}','RouteController@show')->name('routes.show');
Route::get('/routes/{route}/edit','RouteController@edit')->name('routes.edit');
Route::put('/routes/{route}','RouteController@update')->name('routes.update');
Route::post('/routes', 'RouteController@store')->name('routes.store');
Route::delete('/route/{route}', 'RouteController@delete')->name('route.delete');
//Maintenances
Route::get('/maintenances/new', 'MaintenanceController@create')->name('maintenances.new');
Route::get('/maintenances/index', 'MaintenanceController@index')->name('maintenances.index');
Route::get('/maintenances/calendar', 'MaintenanceController@calendar')->name('maintenances.calendar');
Route::get('/maintenances/getMaintenances', 'MaintenanceController@getMaintenances');
Route::get('/maintenances/getRoutes', 'MaintenanceController@getRoutes');
Route::get('/maintenances/{maintenance}','MaintenanceController@show')->name('maintenance.show');
Route::get('/maintenances/{maintenance}/edit','MaintenanceController@edit')->name('maintenance.edit');
Route::put('/maintenances/{maintenance}','MaintenanceController@update')->name('maintenance.update');
Route::post('/maintenances', 'MaintenanceController@store')->name('maintenances.store');
Route::delete('/maintenances/{maintenance}', 'MaintenanceController@delete')->name('maintenance.delete');
