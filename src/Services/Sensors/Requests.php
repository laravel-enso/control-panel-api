<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use LaravelEnso\ActionLogger\Models\ActionLog as Model;

class Requests extends Sensor
{
    public function value(): mixed
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
