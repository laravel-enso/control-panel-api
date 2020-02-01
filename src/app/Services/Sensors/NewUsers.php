<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use LaravelEnso\Core\App\Models\User;

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
