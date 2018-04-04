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
  Route::post('/link', 'HomeController@link');
  Route::get('maps', 'HomeController@maps')->name('maps');
  // Route::get('addNameIndex', 'HomeController@addNameIndex')->name('addNameIndex');
  // Route::get('/maps/{id}', 'HomeController@maps')->name('maps');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['role:guard,admin'])->group(function(){
  Route::get('/strandwacht', function () {
      return view('welcome');
  });
  // Route::get('/strandwacht', 'GuardController@index')->name('Strandwacht');
});
Route::middleware(['role:admin'])->group(function(){
  Route::get('/admin', 'AdminController@index')->name('Admin');
});
