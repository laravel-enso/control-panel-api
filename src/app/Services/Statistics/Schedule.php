<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\Cache;

class Schedule extends BaseSensor
{
    public function value()
    {
        return Cache::has('schedule_monitor');
    }
}
