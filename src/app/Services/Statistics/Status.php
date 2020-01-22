<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class Status extends BaseSensor
{
    public function value()
    {
        return app()->isDownForMaintenance() ? 'down' : 'up';
    }
}
