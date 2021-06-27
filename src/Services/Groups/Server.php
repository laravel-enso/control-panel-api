<?php

namespace LaravelEnso\ControlPanelApi\Services\Groups;

use LaravelEnso\ControlPanelApi\Services\Sensors\Disk;
use LaravelEnso\ControlPanelApi\Services\Sensors\Load;
use LaravelEnso\ControlPanelApi\Services\Sensors\LogSize;
use LaravelEnso\ControlPanelApi\Services\Sensors\Memory;
use LaravelEnso\ControlPanelApi\Services\Sensors\RequestMonitor;
use LaravelEnso\ControlPanelApi\Services\Sensors\Time;
use LaravelEnso\ControlPanelCommon\Contracts\Group;
use LaravelEnso\ControlPanelCommon\Services\IdProvider;

class Server extends IdProvider implements Group
{
    public function label(): string
    {
        return 'Server';
    }

    public function sensors(): array
    {
        return [
            Load::class, Memory::class, Disk::class,
            LogSize::class, Time::class, RequestMonitor::class,
        ];
    }

    public function order(): int
    {
        return 200;
    }
}
