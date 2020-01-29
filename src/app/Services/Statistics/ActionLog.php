<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\ActionLogger\App\Models\ActionLog as Model;

class ActionLog extends BaseSensor
{
    public function value()
    {
        return $this->filter(Model::query())->count();
    }

    public function tooltip(): string
    {
        return 'actions';
    }

    public function description(): ?string
    {
        return 'number of actions';
    }

    public function icon()
    {
        return ['fad', 'mouse-alt'];
    }
}
