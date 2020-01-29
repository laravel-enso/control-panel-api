<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\Login as Model;

class Login extends BaseSensor
{
    public function value()
    {
        return $this->filter(Model::query())->count();
    }

    public function tooltip(): string
    {
        return 'logins';
    }

    public function description(): ?string
    {
        return 'number of logins';
    }

    public function icon()
    {
        return ['fad', 'sign-in-alt'];
    }
}
