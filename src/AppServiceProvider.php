<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Passport::routes();

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->app['router']->aliasMiddleware('passport', CheckClientCredentials::class);
    }

    public function register()
    {
        //
    }
}
