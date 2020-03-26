<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use LaravelEnso\ActionLogger\App\Models\ActionLog as Model;

class Requests extends Sensor
{
    public function value()
    {
        return $this->filter(Model::query())->count();
    }

    public function tooltip(): string
    {
        return 'requests count';
    }

    public function icon(): array
    {
        return ['fad', 'mouse-alt'];
    }

    public function order(): int
    {
        return 200;
    }
}
