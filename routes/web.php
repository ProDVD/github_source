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

Route::get('/test', 'HomeController@test');
Route::get('/docmode', 'HomeController@docmode');
Route::get('/patient', 'HomeController@patient')->name('patient.index');
Route::get('/ajax/{id}', 'HomeController@ajax');
Route::get('/search/{id}', 'HomeController@search');
Route::get('/getfiles/{id}', 'HomeController@getFiles');


Route::get('/', function () {
    return view('index');
});
Route::post('/switcher', 'HomeController@switcher');