<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Actions;

use LaravelEnso\ControlPanelApi\App\Contracts\Action;
use LaravelEnso\Logs\App\Services\ClearLog as Service;

class ClearLog implements Action
{
    public function handle()
    {
        (new Service('laravel.log'))->handle();
    }

    public function label(): string
    {
        return 'Clear logs';
    }

    public function description(): string
    {
        return 'clear logs';
    }

    public function icon()
    {
        return 'trash-alt';
    }

    public function confirmation(): bool
    {
        return true;
    }
}
