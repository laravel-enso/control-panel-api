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

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
    }

    /**
     * Register the application providers.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
