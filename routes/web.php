<?php

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/otp-verification', 'Auth\VerifyOTPController@show')->name('otp-verification');
    Route::patch('/verify-opt', 'Auth\VerifyOTPController@verify')->name('verify-otp');

    Route::middleware([CheckOTP::class])->group(function () {

        // Profiles
        Route::get('profiles', 'ProfileController@create')->name('profiles.create');
    });

    Route::middleware([CheckOTP::class, CheckProfile::class])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');

        // Users
        Route::get('users', 'UserController@index')->name('users.index');
        Route::get('users/{user}', 'UserController@show')->name('users.show');
        Route::get('users/donors/show', 'UserController@showDonors')->name('users.show-donors');

        // Profile
        Route::get('profile-jurisdictions/{profile}/edit', 'ProfileJurisdictionController@edit')->name('profile_jurisdictions.edit');

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
        Route::get('donation-donors/{donation}', 'DonationDonorController@index')->name('donation-donors.index');
        // File upload for donation
        Route::post('files/{donation}', 'FileController@store')->name('files.store');

        // Payment
        Route::get('payments/{donation}', 'PaymentController@index')->name('payments.index');
        Route::get('payments', 'PaymentController@redirectToGateway')->name('payments.pay');
        Route::get('paymentsd', 'PaymentController@myPaid')->name('payments.paid');
        Route::get('initiate-payment/{donationDonor}', 'InitiatePayment')->name('initiate-payment');
        Route::get('verify-payment', 'VerifyPayment')->name('verify-payment');
        Route::get('donation-payments/{payment}/confirm', 'DonationPaymentController@confirm')->name('donation_payments.confirm');
        Route::get('donation-payments', 'DonationPaymentController@index')->name('donation_payments.index');

        // Prescriptions
        Route::resource('prescriptions', 'PrescriptionController')->only([
            'index', 'show'
        ]);

        // UserReviews
        Route::get('user-reviews', 'UserReviewController@index')->name('user_reviews.index');
        Route::get('user-reviews/create/{donation}', 'UserReviewController@create')->name('user_reviews.create');
        Route::post('user-reviews', 'UserReviewController@store')->name('user_reviews.store');

        // History
        Route::get('histories', 'ShowUserHistory')->name('histories.index');

        // ETA
        Route::get('eta-maps/{id}', 'ShowETAMap')->name('eta-maps.index');

        // Settings
        Route::get('settings/show', 'SettingController@show')->name('settings.show');

        // Hospitals
        Route::get('hospitals', 'HospitalController@index')->name('hospitals.index');
    });
});
