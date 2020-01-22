<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\User as Model;

class User extends BaseStatistics
{
    public function handle()
    {
        return Model::count();
    }
}
