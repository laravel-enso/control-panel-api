<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\User;

class ActiveUser extends BaseSensor
{
    public function value()
    {
        return User::active()->count();
    }

    public function description(): string
    {
        return 'number of active users';
    }

    public function icon()
    {
        return 'user-friends';
    }

    public function class(): string
    {
        return '';
    }
}
