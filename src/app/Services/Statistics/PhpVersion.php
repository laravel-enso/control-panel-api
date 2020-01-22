<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class PhpVersion extends BaseStatistics
{
    public function handle()
    {
        return PHP_VERSION;
    }
}
