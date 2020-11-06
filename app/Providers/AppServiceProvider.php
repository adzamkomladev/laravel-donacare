<?php

namespace App\Providers;

use App\Donation;
use App\Observers\DonationObserver;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        Donation::observe(DonationObserver::class);

        $charts->register([
            \App\Charts\DonationPieChart::class
        ]);
    }
}
