<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Actions;

use Illuminate\Support\Facades\Artisan;
use LaravelEnso\ControlPanelApi\App\Contracts\Action;

class Maintenance implements Action
{
    public function id()
    {
        return 'maintenance';
    }

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

    public function tooltip(): string
    {
        return 'this action will toggle maintenance mode.';
    }

    public function description(): string
    {
        return 'toggle maintenance';
    }

    public function icon()
    {
        return ['fad', 'power-off'];
    }

    public function confirmation(): bool
    {
        return true;
    }

    public function order(): int
    {
        return -100;
    }
}
