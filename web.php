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

//Canoe
Route::resource('/canoe', 'CanoeController');
Route::resource('/canoeform', 'FormController');
Route::post('/canoeform/fetch', 'FormController@fetch')->name('canoeform.fetch');
Route::post('/canoeform/fetch2', 'FormController@fetch2')->name('canoeform.fetch2');
Route::post('/canoeform/submit', 'FormController@submit')->name('canoeform.submit');
