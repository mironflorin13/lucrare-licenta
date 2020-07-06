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
Route::redirect('/home','/patient/allD');

Auth::routes(); 

Route::group(['namespace' => 'Patient','middleware'=>['auth'],'prefix'=>'patient'],function(){

    Route::resource('/', 'PatientController');
    Route::get('/allD','PatientController@showDentists');
    Route::POST('/allD','PatientController@createAppointment')->name("createAppointment");
    Route::POST('/reviews','PatientController@createReview')->name("createReview");
    Route::get('/allD/{user}','PatientController@viewDentistProfile')->name("patient.viewDProfile");
    Route::get('/hours','PatientController@checkAvailableHours');
    
});

Route::group(['prefix'=>'dentist'],function(){

    //Login and Register routes
    Route::GET('/login', 'Auth\DentistLoginController@showLoginForm')->name('dentist.login');
    Route::POST('/login', 'Auth\DentistLoginController@login')->name('dentist.login.submit');
    Route::GET('/register', 'Auth\DentistRegisterController@showRegisterForm')->name('dentist.register');
    Route::POST('/register', 'Auth\DentistRegisterController@create')->name('dentist.register.submit');
    

    // Password reset routes
    Route::POST('/password/email','Auth\DentistForgotPasswordController@sendResetLinkEmail')->name('dentist.password.email');
    Route::GET('/password/reset','Auth\DentistForgotPasswordController@showLinkRequestForm')->name('dentist.password.request');
    Route::POST('/password/reset','Auth\DentistResetPasswordController@reset');
    Route::GET('/password/reset/{token}','Auth\DentistResetPasswordController@showResetForm')->name('dentist.password.reset');
    
    Route::group(['middleware'=>['auth:dentist']],function(){

        Route::redirect('/', '/dentist/appointments');

        Route::PATCH('/profile/{user}', 'DentistsProfilesController@update');
        Route::get('/profile/{user}', 'DentistsProfilesController@index');
        Route::get('/profile/{user}/edit', 'DentistsProfilesController@edit');

        Route::resource('/services', 'DentistsServicesController');
       
        Route::get('/appointments','DentistAppointmentController@index');
        Route::POST('/appointments','DentistAppointmentController@store')->name('dentist.dashboard'); 
        Route::PUT('/appointments/{id}','DentistAppointmentController@update');
        Route::DELETE('/appointments/{id}','DentistAppointmentController@destroy');

        Route::get('/calendar','DentistAppointmentController@calendar');

        Route::get('/reviews','DentistAppointmentController@reviews');
    });
});
