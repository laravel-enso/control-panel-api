<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\ActionLogger\App\Models\ActionLog as Model;

class ActionLog extends BaseStatistics
{
    public function handle()
    {
        return $this->filter(Model::query())->count();
    }
}
