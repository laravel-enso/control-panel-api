<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Sensors\FailedJobs;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\PendingJobs;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Jobs implements Group
{
    public function id()
    {
        return 'jobs';
    }

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
