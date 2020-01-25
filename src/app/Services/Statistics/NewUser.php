<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\User;

class NewUser extends BaseSensor
{
    public function value()
    {
        return $this->filter(User::query())->count();
    }

    public function description(): string
    {
        return 'number of new users';
    }

    public function icon()
    {
        return ['fad', 'user-plus'];
    }
}
