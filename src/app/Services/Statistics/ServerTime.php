<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Carbon\Carbon;

class ServerTime extends BaseStatistics
{
    public function handle()
    {
        return Carbon::now()->format('H:i');
    }
}
