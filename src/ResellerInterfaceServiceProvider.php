<?php

namespace TeamNiftyGmbH\ResellerInterface;

use Illuminate\Support\ServiceProvider;

class ResellerInterfaceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/resellerinterface.php' => config_path('resellerinterface.php'),
            ], 'resellerinterface-config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/resellerinterface.php',
            'resellerinterface'
        );

        $this->app->singleton(ResellerInterface::class, function ($app) {
            return new ResellerInterface(
                username: config('resellerinterface.username'),
                password: config('resellerinterface.password'),
                resellerId: config('resellerinterface.reseller_id')
                    ? (int) config('resellerinterface.reseller_id')
                    : null,
                baseUrl: config('resellerinterface.base_url')
            );
        });
    }
}
