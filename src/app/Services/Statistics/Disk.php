<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Helpers\App\Classes\Decimals;

class Disk extends BaseSensor
{
    public function value()
    {
        return "{$this->freeDisk()} GB";
    }

    public function tooltip(): string
    {
        return 'free disk';
    }

    public function description(): ?string
    {
        return 'free disk space in GigaBytes';
    }

    public function icon()
    {
        return ['fad', 'hdd'];
    }

    public function order(): int
    {
        return 300;
    }

    private function freeDisk(): string
    {
        return Decimals::div(disk_free_space('/'), 1024 ** 3);
    }
}
