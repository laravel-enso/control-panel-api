<?php

namespace LaravelEnso\ControlPanelApi\Services\Groups;

use LaravelEnso\ControlPanelApi\Services\Sensors\FailedJobs;
use LaravelEnso\ControlPanelApi\Services\Sensors\PendingJobs;
use LaravelEnso\ControlPanelCommon\Contracts\Group;
use LaravelEnso\ControlPanelCommon\Services\IdProvider;

class Jobs extends IdProvider implements Group
{
    public function label(): string
    {
        return 'Jobs';
    }

    public function sensors(): array
    {
        return [
            PendingJobs::class, FailedJobs::class,
        ];
    }

    public function order(): int
    {
        return 600;
    }
}
