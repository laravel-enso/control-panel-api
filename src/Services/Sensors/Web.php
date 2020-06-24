<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

class Web extends Sensor
{
    public function value()
    {
        return 'Web';
    }

    public function tooltip(): string
    {
        return 'application status';
    }

    public function icon(): array
    {
        return app()->isDownForMaintenance()
            ? ['fad', 'pause-circle']
            : ['fad', 'check-circle'];
    }

    public function class(): string
    {
        return app()->isDownForMaintenance()
            ? 'has-text-warning'
            : 'has-text-success';
    }

    public function order(): int
    {
        return 100;
    }
}
