<?php

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

    Route::patch('/profiles/{profile}', 'ProfileController@update');

    Route::patch('/services/{service}/toggle-availability', 'ServiceController@toggleAvailability');
    Route::put('/services/{service}', 'ServiceController@update');

    Route::put('/complaints/{complaint}', 'ComplaintController@update');

    Route::post('/locations', 'LocationController@store');

    Route::patch('/service-requests/{serviceRequest}/select-donor', 'ServiceRequestController@selectDonor');
    Route::patch('/service-requests/{serviceRequest}/update-status', 'ServiceRequestController@updateStatus');
});
