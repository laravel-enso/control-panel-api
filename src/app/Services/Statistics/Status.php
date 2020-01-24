<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class Status extends BaseSensor
{
    public function value()
    {
        return 'Web';
    }

    public function description(): string
    {
        return 'application status';
    }

    public function icon()
    {
        return app()->isDownForMaintenance()
            ? 'pause-circle'
            : 'check-circle';
    }

    public function class(): string
    {
        return app()->isDownForMaintenance()
            ? 'has-text-warning'
            : 'has-text-success';
    }
}
