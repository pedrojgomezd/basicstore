<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dnetix\Redirection\PlacetoPay;

class PlacetoPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PlacetoPay::class, function ($app) {
            return new PlacetoPay([
                'login' => config('placetopay.login'),
                'tranKey' => config('placetopay.tranKey'),
                'url' => config('placetopay.url'),
                'type' => PlacetoPay::TP_REST
            ]);
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
