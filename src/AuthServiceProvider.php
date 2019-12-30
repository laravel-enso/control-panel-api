<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\Core\App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::viaRequest('token', fn ($request) => $this->auth($request));
    }

    private function auth($request)
    {
        return config('enso.config.ensoApiToken') === $request->header('Api-Token')
            ? new User()
            : null;
    }
}
