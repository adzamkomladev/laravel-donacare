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

Route::middleware('auth:api')->get('/user', 'API\AuthController@currentUser');

Route::group(['prefix' => 'v1'], function () {
    Route::patch('/users/{user}/toggle-activation', 'UserController@toggleActivation');
    Route::get('/users/{user}/donations', 'UserController@donations');

    Route::patch('/profiles/{profile}', 'ProfileController@update');
    Route::post('profiles/user/{user}', 'ProfileController@store');
    Route::patch('profile-jurisdictions/{profile}', 'ProfileJurisdictionController@update');

    Route::patch('/services/{service}/toggle-availability', 'ServiceController@toggleAvailability');
    Route::put('/services/{service}', 'ServiceController@update');

    Route::put('/complaints/{complaint}', 'ComplaintController@update');

    Route::post('/locations', 'LocationController@store');
    Route::get('/locations/{user}', 'LocationController@show');

    Route::get('/donations', 'DonationController@allDonations');
    Route::patch('/donations/{donation}/select-donor', 'DonationController@selectDonor');
    Route::patch('/donations/{donation}/deselect-donor', 'DonationController@deselectDonor');
    Route::patch('/donations/{donation}/update-status', 'DonationController@updateStatus');
    Route::post('/donations', 'DonationController@store');

    Route::resource('donation-donors', 'DonationDonorController')->only([
        'store', 'update', 'delete'
    ]);

    // Notifications
    Route::get('/notifications/donations/{user}/new', 'NotificationController@newDonationsNotifications');

    // Settings
    Route::post('settings', 'SettingController@store');
    Route::get('settings/current', 'CurrentSettings');
});

Route::group(['prefix' => 'v2'], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/user', 'API\AuthController@currentUser');

        Route::post('verify-otp', 'API\AuthController@verifyOtp');

        Route::middleware([CheckOTP::class])->group(function () {
            Route::post('profiles', 'API\ProfileController@store');
            Route::get('profiles/{id}', 'API\ProfileController@show');
            Route::put('profiles/{id}', 'API\ProfileController@update');

            Route::get('users', 'API\UserController@index');
            Route::get('users/{id}', 'API\UserController@show');
            Route::put('users/{id}', 'API\UserController@update');

            Route::get('donations/{id}', 'API\DonationController@userDonations');
            Route::post('donations', 'API\DonationController@store');

            Route::resource('donation-donors', 'API\DonationDonorController')->only([
                'store', 'update', 'destroy'
            ]);
            Route::get('user-donations/{id}', 'API\UserDonations');
            Route::get('incoming-donations', 'API\IncomingDonations');
            Route::get('active-donation', 'API\ActiveDonation');

            Route::get('locations/{id}', 'API\LocationController@update');

            Route::get('services', 'API\ServiceController@index');

            Route::get('settings/current', 'API\CurrentSettings');
        });
    });
});
