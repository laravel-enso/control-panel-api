<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

class PhpVersion extends Sensor
{
    public function value()
    {
        return PHP_VERSION;
    }

    public function tooltip(): string
    {
        return 'php version';
    }

    public function icon(): array
    {
        return ['fab', 'php'];
    }

    public function order(): int
    {
        return 200;
    }
}
