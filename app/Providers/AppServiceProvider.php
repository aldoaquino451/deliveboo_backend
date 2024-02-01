<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(Gateway::class, function($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'b22n4gtx5t4h7dc7',
                    'publicKey' => '9c79dxxm47vsbghn',
                    'privateKey' => '5a154ed3a5b5f55f927a8797d43a346c'
                ]
            );

        });

        Paginator::useBootstrapFive();
    }
}
