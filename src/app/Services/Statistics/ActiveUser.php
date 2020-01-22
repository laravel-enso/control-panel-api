<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\User;

class ActiveUser extends BaseStatistics
{
    public function handle()
    {
        return User::active()->count();
    }
}
