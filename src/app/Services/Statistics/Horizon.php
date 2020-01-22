<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\App;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

class Horizon extends BaseStatistics
{
    public function handle()
    {
        $masters = App::make(MasterSupervisorRepository::class)->all();

        if (! $masters) {
            return 'inactive';
        }

        return collect($masters)->contains(function ($master) {
            return $master->status === 'paused';
        }) ? 'paused' : 'running';
    }
}
