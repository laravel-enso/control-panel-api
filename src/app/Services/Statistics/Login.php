<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\Login as Model;

class Login extends BaseStatistics
{
    public function handle()
    {
        return $this->filter(Model::query())->count();
    }
}
