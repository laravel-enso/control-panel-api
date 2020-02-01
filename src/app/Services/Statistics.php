<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Activity;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Jobs;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Server;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Services;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Users;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Versions;

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
        return (new Collection($this->stats))
            ->map(fn ($group) => App::make($group));
    }
}
