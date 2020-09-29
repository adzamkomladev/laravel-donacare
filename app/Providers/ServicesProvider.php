<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\PrescriptionService', function ($app) {
            return new \App\Services\PrescriptionService(new \App\Services\FileUploadService());
        });

        $this->app->bind('App\Services\DonationService', function ($app) {
            return new \App\Services\DonationService($app->make('App\Services\PrescriptionService'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
