<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\Queue;

class QueueSize extends BaseSensor
{
    public function value()
    {
        return Queue::size();
    }
}
