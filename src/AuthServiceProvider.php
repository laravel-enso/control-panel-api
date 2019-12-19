<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\Core\app\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::viaRequest('token', fn($request) => (
            config('enso.config.ensoApiToken') === $request->header('Api-Token')
                ? new User()
                : null
        ));
    }
}
