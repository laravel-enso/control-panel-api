<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Actions;

use LaravelEnso\ControlPanelCommon\App\Contracts\Action;
use LaravelEnso\Logs\App\Services\ClearLog as Service;

class ClearLog implements Action
{
    public function id()
    {
        return 'clearLog';
    }

    public function handle()
    {
        (new Service('laravel.log'))->handle();
    }

    public function label(): string
    {
        return 'Log';
    }

    public function tooltip(): string
    {
        return 'clear logs';
    }

    public function description(): string
    {
        return 'this action will clear laravel log';
    }

    public function icon()
    {
        return ['fad', 'trash-alt'];
    }

    public function confirmation(): bool
    {
        return true;
    }

    public function order(): int
    {
        return 300;
    }
}
