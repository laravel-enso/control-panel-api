<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\Queue;

class QueueSize extends BaseStatistics
{
    public function handle()
    {
        return Queue::size();
    }
}
