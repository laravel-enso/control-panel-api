<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Statistics\Horizon;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Schedule;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Status as Stat;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Status implements Group
{
    public function id()
    {
        return 'status';
    }

    public function label(): string
    {
        return 'Status';
    }

    public function statistics(): array
    {
        return [
            Stat::class, Schedule::class, Horizon::class,
        ];
    }

    public function order(): int
    {
        return 100;
    }
}
