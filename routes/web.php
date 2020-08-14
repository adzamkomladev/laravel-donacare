<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/otp-verification', 'Auth\VerifyOTPController@show')->name('otp-verification');
Route::patch('/verify-opt', 'Auth\VerifyOTPController@verify')->name('verify-otp');

Route::get('/home', 'HomeController@index')->name('home');

// Users
Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/{user}', 'UserController@show')->name('users.show');

// Profile
Route::get('profiles/create', 'ProfileController@create')->name('profiles.create');
Route::post('profiles', 'ProfileController@store')->name('profiles.store');

// Services
Route::get('services', 'ServiceController@index')->name('services.index');
Route::get('services/create', 'ServiceController@create')->name('services.create');
Route::post('services', 'ServiceController@store')->name('services.store');

// Complaints
Route::get('complaints', 'ComplaintController@index')->name('complaints.index');
Route::get('complaints/create', 'ComplaintController@create')->name('complaints.create');
Route::post('complaints', 'ComplaintController@store')->name('complaints.store');

// Service request
Route::get('service-requests/create/step-one', 'ServiceRequestController@createStepOne')->name('service-requests.create.step-one');
Route::post('service-requests/step-one', 'ServiceRequestController@storeStepOne')->name('service-requests.store.step-one');
Route::get('service-requests/create/step-two/{serviceRequest}', 'ServiceRequestController@createStepTwo')->name('service-requests.create.step-two');
Route::get('service-requests/create/step-three/{serviceRequest}', 'ServiceRequestController@createStepThree')->name('service-requests.create.step-three');


// File upload for service request
Route::post('files/{serviceRequest}', 'FileController@store')->name('files.store');
