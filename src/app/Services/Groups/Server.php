<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Statistics\Disk;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Load;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Memory;
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

    public function statistics(): array
    {
        return [
            Load::class, Memory::class, Disk::class,
        ];
    }

    public function order(): int
    {
        return 200;
    }
}
