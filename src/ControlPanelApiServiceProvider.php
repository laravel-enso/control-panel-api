<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;

class ControlPanelApiServiceProvider extends ServiceProvider
{
    private $providers = [
        AuthServiceProvider::class,
        PassportServiceProvider::class,
    ];

    public function boot()
    {
        Passport::routes();

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/controlpanelapi');
    }

    public function register()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
