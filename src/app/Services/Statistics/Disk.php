<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Helpers\App\Classes\Decimals;

class Disk extends BaseStatistics
{
    public function handle()
    {
        return Decimals::div(disk_free_space('/'), 1024 ** 3);
    }
}
