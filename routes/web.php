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
Route::get('profiles/create', 'ProfileController@create')->name('profiles.create');
Route::post('profiles', 'ProfileController@store')->name('profiles.store');

// Services
Route::get('services', 'ServiceController@index')->name('services.index');
