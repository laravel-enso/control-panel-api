<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Helpers\App\Classes\Decimals;

class Disk extends BaseSensor
{
    public function value()
    {
        return Decimals::div(disk_free_space('/'), 1024 ** 3);
    }
}
