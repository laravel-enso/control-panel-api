<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;

class ControlPanelApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        //for passport oauth client_credentials type of authorization
        $this->app['router']->aliasMiddleware('passport', \Laravel\Passport\Http\Middleware\CheckClientCredentials::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
