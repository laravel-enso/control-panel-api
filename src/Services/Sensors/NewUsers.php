<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use LaravelEnso\Users\Models\User;

class NewUsers extends Sensor
{
    public function value()
    {
        return $this->filter(User::query())->count();
    }

    public function tooltip(): string
    {
        return 'new users';
    }

    public function icon(): array
    {
        return ['fad', 'user-plus'];
    }

    public function order(): int
    {
        return 100;
    }
}
