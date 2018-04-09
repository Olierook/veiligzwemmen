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

Route::middleware(['role:parent'])->group(function(){
  Route::post('/home/wrong_code', 'HomeController@link');
  Route::get('maps', 'HomeController@maps')->name('maps');
  Route::get('/home', 'HomeController@index');
  // Route::get('addNameIndex', 'HomeController@addNameIndex')->name('addNameIndex');
  // Route::get('/maps/{id}', 'HomeController@maps')->name('maps');
});

Route::get('/link', 'HomeController@firstlogin')->name('home');


Route::middleware(['role:guard,admin'])->group(function(){
  Route::get('/fullmap', 'GuardController@maps');
  // Route::get('/strandwacht', 'GuardController@index')->name('Strandwacht');
});
Route::middleware(['role:admin'])->group(function(){
  Route::get('/adminhome', 'AdminController@index')->name('Admin');
});
