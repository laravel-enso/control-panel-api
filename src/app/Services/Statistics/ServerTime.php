<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Carbon\Carbon;

class ServerTime extends BaseSensor
{
    public function value()
    {
        return Carbon::now()->format('H:i');
    }
}
