<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\Cache;

class Schedule extends BaseStatistics
{
    public function handle()
    {
        return Cache::has('schedule_monitor');
    }
}
