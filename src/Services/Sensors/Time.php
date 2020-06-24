<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Carbon\Carbon;

class Time extends Sensor
{
    public function value()
    {
        return Carbon::now()->format('H:i');
    }

    public function tooltip(): string
    {
        return 'server time';
    }

    public function icon(): array
    {
        return ['fad', 'clock'];
    }

    public function order(): int
    {
        return 500;
    }
}
