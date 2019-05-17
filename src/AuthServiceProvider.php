<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\Facades\Auth;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::viaRequest('token', function ($request) {
            return config('enso.config.ensoApiToken') === $request->header('Api-Token')
                ? new User()
                : null;
        });
    }
}
