<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Actions;

use Illuminate\Support\Facades\Artisan;
use LaravelEnso\ControlPanelApi\App\Contracts\Action;

class Maintenance implements Action
{
    public function handle()
    {
        return app()->isDownForMaintenance()
            ? Artisan::call('up')
            : Artisan::call('down');
    }

    public function label(): string
    {
        return 'App';
    }

    public function description(): string
    {
        return 'toggle maintenance';
    }

    public function icon()
    {
        return 'power-off';
    }

    public function confirmation(): bool
    {
        return true;
    }
}
