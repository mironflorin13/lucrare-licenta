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
Route::redirect('/home','/patient');

Auth::routes(); 
    Route::group(['namespace' => 'Patient','middleware'=>['auth'],'prefix'=>'patient'],function(){

       Route::resource('/', 'PatientController');
       Route::get('allD','PatientController@showDentists');
       Route::POST('allD/','PatientController@createAppointment')->name("createAppointment");
       Route::get('allD/{user}','PatientController@viewDentistProfile')->name("patient.viewDProfile");
       
    });

    Route::get('dentist/login', 'Auth\DentistLoginController@showLoginForm')->name('dentist.login');
    Route::post('dentist/login', 'Auth\DentistLoginController@login')->name('dentist.login.submit');
    Route::get('dentist/register', 'Auth\DentistRegisterController@showRegisterForm')->name('dentist.register');
    Route::POST('dentist/register', 'Auth\DentistRegisterController@create')->name('dentist.register.submit');
    
    Route::group(['middleware'=>['auth:dentist'],'prefix'=>'dentist'],function(){

        Route::get('/', 'Dentist\DentistController@index')->name('dentist.dashboard');

        Route::PATCH('/profile/{user}', 'DentistsProfilesController@update');
        Route::get('/profile/{user}', 'DentistsProfilesController@index');
        
        Route::get('/profile/{user}/edit', 'DentistsProfilesController@edit');

        Route::resource('/services', 'DentistsServicesController');
        Route::POST('/services/addService','DentistsServicesController@addService');
        Route::POST('/services/editService','DentistsServicesController@editService');
        Route::POST('/services/deleteService','DentistsServicesController@deleteService');

        Route::get('/appointments','DentistAppointmentController@index');
        Route::POST('/appointments','DentistAppointmentController@addAppointment')->name('appointments.add'); 
        Route::POST('/appointments/editAppointment','DentistAppointmentController@editAppointment');
        Route::POST('/appointments/deleteAppointment','DentistAppointmentController@deleteAppointment');

        Route::get('/calendar','DentistAppointmentController@calendar');

    });
    