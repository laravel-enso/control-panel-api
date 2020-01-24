<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\ActionLogger\App\Models\ActionLog as Model;

class ActionLog extends BaseSensor
{
    public function value()
    {
        return $this->filter(Model::query())->count();
    }

    public function description(): string
    {
        return __('number of actions');
    }

    public function icon()
    {
        return 'mouse-alt';
    }

    public function class(): string
    {
        return '';
    }
}
