<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class Version extends BaseStatistics
{
    public function handle()
    {
        return config('enso.config.version');
    }
}
