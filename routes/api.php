<?php

use App\Http\Middleware\CheckOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::patch('/users/{user}/toggle-activation', 'UserController@toggleActivation');
    Route::get('/users/{user}/service-requests', 'UserController@serviceRequests');

    Route::patch('/profiles/{profile}', 'ProfileController@update');
    Route::patch('profiles/{profile}/jurisdiction', 'ProfileController@updateJurisdiction');

    Route::patch('/services/{service}/toggle-availability', 'ServiceController@toggleAvailability');
    Route::put('/services/{service}', 'ServiceController@update');

    Route::put('/complaints/{complaint}', 'ComplaintController@update');

    Route::post('/locations', 'LocationController@store');

    Route::get('/service-requests', 'ServiceRequestController@allServiceRequests');
    Route::patch('/service-requests/{serviceRequest}/select-donor', 'ServiceRequestController@selectDonor');
    Route::patch('/service-requests/{serviceRequest}/update-status', 'ServiceRequestController@updateStatus');
});

Route::group(['prefix' => 'v2'], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('verify-otp', 'API\AuthController@verifyOtp');

        Route::middleware([CheckOTP::class])->group(function () {
            Route::post('profiles', 'API\ProfileController@store');
            Route::get('profiles/{id}', 'API\ProfileController@show');
            Route::put('profiles/{id}', 'API\ProfileController@update');

            Route::get('users', 'API\UserController@index');
            Route::get('users/{id}', 'API\UserController@show');
            Route::put('users/{id}', 'API\UserController@update');
        });
    });
});



