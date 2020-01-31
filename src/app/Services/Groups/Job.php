<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Statistics\FailedJob;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Job as Stat;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Job implements Group
{
    public function id()
    {
        return 'job';
    }

    public function label(): string
    {
        return 'Job';
    }

    public function statistics(): array
    {
        return [
            Stat::class, FailedJob::class,
        ];
    }

    public function order(): int
    {
        return 600;
    }
}
