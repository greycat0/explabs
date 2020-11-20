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

Route::get('/', 'HomeController@index');

Route::post('/task/{id}','TaskController@choose');

Route::get('/tasks', 'TaskController@index');

Route::get('/dev', 'DevController@index');

//admin's

Route::post('/task', 'TaskController@store');

Route::post('/taskChange/{id}', 'TaskController@update');

Route::delete('/task/{id}','TaskController@destroy');

Auth::routes();