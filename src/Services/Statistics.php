<?php

namespace LaravelEnso\ControlPanelApi\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\ControlPanelApi\Services\Groups\Activity;
use LaravelEnso\ControlPanelApi\Services\Groups\Jobs;
use LaravelEnso\ControlPanelApi\Services\Groups\Server;
use LaravelEnso\ControlPanelApi\Services\Groups\Services;
use LaravelEnso\ControlPanelApi\Services\Groups\Users;
use LaravelEnso\ControlPanelApi\Services\Groups\Versions;

class Statistics
{
    private array $stats = [
        Services::class,
        Server::class,
        Users::class,
        Versions::class,
        Activity::class,
        Jobs::class,
    ];

    public function register($registers)
    {
        $this->stats = [...$this->stats, ...$registers];
    }

    public function all()
    {
        return (Collection::wrap($this->stats)
            ->map(fn ($group) => App::make($group));
    }
}
