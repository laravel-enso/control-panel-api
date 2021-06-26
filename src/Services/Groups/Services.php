<?php

namespace LaravelEnso\ControlPanelApi\Services\Groups;

use LaravelEnso\ControlPanelApi\Services\IdProvider;
use LaravelEnso\ControlPanelApi\Services\Sensors\Horizon;
use LaravelEnso\ControlPanelApi\Services\Sensors\Scheduler;
use LaravelEnso\ControlPanelApi\Services\Sensors\Web;
use LaravelEnso\ControlPanelCommon\Contracts\Group;

class Services extends IdProvider implements Group
{
    public function label(): string
    {
        return 'Services';
    }

    public function sensors(): array
    {
        return [
            Web::class, Scheduler::class, Horizon::class,
        ];
    }

    public function order(): int
    {
        return 100;
    }
}
