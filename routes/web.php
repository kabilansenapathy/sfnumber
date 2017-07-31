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

//Route::get('api/{value1}/{value2}', 'ApiController@getdata')->middleware('cors'); 
Route::get('api/city', 'ApiController@getCity')->middleware('cors'); 
Route::get('api/village/{taluk}', 'ApiController@getVillage')->middleware('cors');
Route::get('api/type/{taluk}/{village}/{sfno}', 'ApiController@getType')->middleware('cors'); 
Route::get('api/sf/{village}/{sfno}', 'ApiController@getType')->middleware('cors'); 

Route::get('api/all/all', function () {
    // return view('welcome');

    $all = DB::table('sfdetails')
    ->where('id', '1')

    ->get();
    return $all;

});

Route::get('/ec/village/{srocode}','ApiController@ecVillage');
