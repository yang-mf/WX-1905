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

Route::get('/test/index','Test\TestController@index');
Route::get('/phpinfo','Test\TestController@info');
Route::get('/wx','Test\TestController@wx');
Route::get('/wx/info','Test\TestController@GetUserInfo');
Route::get('/wx/receiv','Test\TestController@receiv');
