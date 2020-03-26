<?php

namespace LaravelEnso\ControlPanelApi\App\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class Monitor extends Command
{
    protected $signature = 'enso:control-panel-api:monitor';

    protected $description = 'Monitor Schedule';

    public function handle()
    {
        Cache::put('scheduler_monitor', Carbon::now(), Carbon::now()->addMinutes(5));
    }
}
