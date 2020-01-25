<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Helpers\App\Classes\Decimals;

class Disk extends BaseSensor
{
    public function value()
    {
        return "{$this->freeDisk()} GB";
    }

    public function description(): string
    {
        return __('free disk');
    }

    public function icon()
    {
        return ['fad', 'hdd'];
    }

    public function class(): string
    {
        return '';
    }

    private function freeDisk(): string
    {
        return Decimals::div(disk_free_space('/'), 1024 ** 3);
    }
}
