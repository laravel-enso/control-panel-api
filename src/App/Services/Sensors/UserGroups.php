<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use LaravelEnso\Core\App\Models\UserGroup;

class UserGroups extends Sensor
{
    public function value()
    {
        return UserGroup::count();
    }

    public function tooltip(): string
    {
        return 'user groups';
    }

    public function icon(): array
    {
        return ['fad', 'users'];
    }

    public function order(): int
    {
        return 300;
    }
}
