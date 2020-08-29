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
    return view('welcome');
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

// Donation
Route::get('donations/create', 'DonationController@create')->name('donations.create');
Route::get('donations/create/step-one', 'DonationController@createStepOne')->name('donations.create.step-one');
Route::post('donations/step-one', 'DonationController@storeStepOne')->name('donations.store.step-one');
Route::get('donations/create/step-two', 'DonationController@createStepTwo')->name('donations.create.step-two');
Route::post('donations/create/step-two', 'DonationController@storeStepTwo')->name('donations.store.step-two');
Route::get('donations/create/step-three/{donation}', 'DonationController@createStepThree')->name('donations.create.step-three');
Route::get('donations/create/step-four/{donation}', 'DonationController@createStepFour')->name('donations.create.step-four');
Route::get('donations', 'DonationController@index')->name('donations.index');
Route::get('donations/{donation}', 'DonationController@show')->name('donations.show');

// File upload for donation
Route::post('files/{donation}', 'FileController@store')->name('files.store');

// Paystack
Route::get('/pay/{donation}', 'PaymentController@index')->name('payment.index');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('payment.pay');
