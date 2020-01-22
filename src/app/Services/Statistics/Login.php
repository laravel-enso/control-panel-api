<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\Login as Model;

class Login extends BaseSensor
{
    public function value()
    {
        return $this->filter(Model::query())->count();
    }
}
