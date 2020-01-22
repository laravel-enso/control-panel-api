<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\App;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

class Horizon extends BaseSensor
{
    public function value()
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
