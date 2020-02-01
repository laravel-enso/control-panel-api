<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Sensors\Disk;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\Load;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\LogSize;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\Memory;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\ResponseTime;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\ServerTime;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Server implements Group
{
    public function id()
    {
        return 'server';
    }

    public function label(): string
    {
        return 'Server';
    }

    public function sensors(): array
    {
        return [
            Load::class, Memory::class, Disk::class,
            LogSize::class, ServerTime::class, ResponseTime::class,
        ];
    }

    public function order(): int
    {
        return 200;
    }
}
