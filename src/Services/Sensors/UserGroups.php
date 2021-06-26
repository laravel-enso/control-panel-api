<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use LaravelEnso\UserGroups\Models\UserGroup;

class UserGroups extends Sensor
{
    public function value(): mixed
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
