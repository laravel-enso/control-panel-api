<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //for passport oauth client_credentials type of authorization
        $this->app['router']->aliasMiddleware('passport', CheckClientCredentials::class);

        \Gate::define('manage-oauth-tokens', function ($user) {
            return $user->isAdmin();
        });
    }
}
