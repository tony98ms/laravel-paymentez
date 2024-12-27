<?php

namespace TonyStore\LaravelPaymentez;

use Illuminate\Support\ServiceProvider;
use TonyStore\LaravelPaymentez\Services\Requestor;

class LaravelPaymentezProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/paymentez.php',
            'paymentez'
        );
        foreach (config('paymentez.api_resources') as $key => $resource) {
            $requestor = new Requestor(config('paymentez.base_url')[$resource['api']], config('paymentez.production'));
            $resourceClass = $resource['class'];
            $this->app->singleton("paymentez-{$key}", function () use ($requestor, $resourceClass) {
                return new $resourceClass($requestor);
            });
        }
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(([
                __DIR__ . '/../config/paymentez.php' => config_path('paymentez.php')
            ]));
        }
    }
}
