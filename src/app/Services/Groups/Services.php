<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Sensors\Horizon;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\Scheduler;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\Web;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Services implements Group
{
    public function id()
    {
        return 'services';
    }

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
