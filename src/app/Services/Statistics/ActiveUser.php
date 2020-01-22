<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\User;

class ActiveUser extends BaseSensor
{
    public function value()
    {
        return User::active()->count();
    }
}
