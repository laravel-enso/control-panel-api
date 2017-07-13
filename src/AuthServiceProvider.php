<?php
/**
 * Created by PhpStorm.
 * User: mihai
 * Date: 7/13/17
 * Time: 3:45 PM.
 */

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //for passport oauth client_credentials type of authorization
        $this->app['router']->aliasMiddleware('passport', CheckClientCredentials::class);

        \Gate::define('manageOauthTokens', function ($user) {
            return $user->role->name === 'admin';
        });
    }
}
