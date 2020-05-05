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
Route::redirect('/home', '/');
Auth::routes(); 

    Route::get('/', 'DentistsProfilesController@index')->name('profile.show');

    Route::get('/profile/{user}', 'DentistsProfilesController@index')->name('profile.show');
    Route::get('/profile/{user}/edit', 'DentistsProfilesController@edit')->name('profile.edit');
    Route::patch('/profile/{user}', 'DentistsProfilesController@update')->name('DentistsProfiles.update');
Route::group(['middleware' => ['web']], function() {
    Route::resource('/services', 'DentistsServicesController');
    Route::POST('/services/addService','DentistsServicesController@addService');
    Route::POST('/services/editService','DentistsServicesController@editService');
    Route::POST('/services/deleteService','DentistsServicesController@deleteService');
});