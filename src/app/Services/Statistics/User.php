<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\User as Model;

class User extends BaseSensor
{
    public function value()
    {
        return Model::count();
    }

    public function tooltip(): string
    {
        return 'users';
    }

    public function description(): ?string
    {
        return 'number of users';
    }

    public function icon()
    {
        return ['fad', 'users'];
    }
}
