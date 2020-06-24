<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Facades\Config;

class Version extends Sensor
{
    public function value()
    {
        return Config::get('enso.config.version');
    }

    public function tooltip(): string
    {
        return 'enso version';
    }

    public function icon(): array
    {
        return ['fab', 'enso'];
    }

    public function order(): int
    {
        return 100;
    }
}
