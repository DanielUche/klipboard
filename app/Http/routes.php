<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', 'HomeController@index');
Route::match(['post','get'], '/index', 'HomeController@index');
Route::match(['post','get'], '/upload-attandance', 'HomeController@import_attend');

Route::match(['post','get'], '/staff/{id?}', 'HomeController@staff');

Route::match(['post','get'], '/staff_ajax/{id?}', 'HomeController@staff');

