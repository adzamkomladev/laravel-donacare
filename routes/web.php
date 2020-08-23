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
Route::get('profiles/step-one', 'ProfileController@createStepOne')->name('profiles.create-step-one');
Route::post('profiles/step-one', 'ProfileController@storeStepOne')->name('profiles.store-step-one');
Route::get('profiles/step-two', 'ProfileController@createStepTwo')->name('profiles.create-step-two');
Route::post('profiles/step-two', 'ProfileController@storeStepTwo')->name('profiles.store-step-two');
Route::post('profiles', 'ProfileController@store')->name('profiles.store');
Route::get('profiles/{profile}/jurisdiction', 'ProfileController@editJurisdiction')->name('profiles.jurisdiction');

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
Route::get('service-requests/create/step-two', 'ServiceRequestController@createStepTwo')->name('service-requests.create.step-two');
Route::post('service-requests/create/step-two', 'ServiceRequestController@storeStepTwo')->name('service-requests.store.step-two');
Route::get('service-requests/create/step-three/{serviceRequest}', 'ServiceRequestController@createStepThree')->name('service-requests.create.step-three');
Route::get('service-requests/create/step-four/{serviceRequest}', 'ServiceRequestController@createStepFour')->name('service-requests.create.step-four');
Route::get('service-requests', 'ServiceRequestController@index')->name('service-requests.index');
Route::get('service-requests/{serviceRequest}', 'ServiceRequestController@show')->name('service-requests.show');

// File upload for service request
Route::post('files/{serviceRequest}', 'FileController@store')->name('files.store');

// Paystack
Route::get('/pay/{serviceRequest}', 'PaymentController@index')->name('payment.index');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('payment.pay');
