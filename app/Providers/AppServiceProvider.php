<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

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
    public function boot()
    {
        
        $this->app->singleton(Gateway::class, function($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'bs7nm6w55j3t96bv',
                    'publicKey' => 'mdrs8n6fb2zpsw76',
                    'privateKey' => 'e4c5d914151bbe1f36a039ec816c304d'
                ]
                );
        });
    }
}
