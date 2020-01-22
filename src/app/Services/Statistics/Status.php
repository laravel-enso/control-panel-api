<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class Status extends BaseStatistics
{
    public function handle()
    {
        return app()->isDownForMaintenance() ? 'down' : 'up';
    }
}
