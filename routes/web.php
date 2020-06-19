<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('api/mlife', 'MywishController');
//Route Group For Admin
Route::group([ 'as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin']],
function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
});

//Route group for Tenant
Route::group([ 'as'=>'user.', 'prefix'=>'user', 'namespace'=>'User', 'middleware'=>['auth','user']],
function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
});
