<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class ControlPanelApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Passport::routes();

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}
