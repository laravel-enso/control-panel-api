<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Core\App\Models\User;

class NewUser extends BaseStatistics
{
    public function handle()
    {
        return $this->filter(User::query())->count();
    }
}
