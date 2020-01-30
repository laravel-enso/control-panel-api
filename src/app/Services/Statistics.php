<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Extra;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Job;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Login;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Server;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Status;
use LaravelEnso\ControlPanelApi\App\Services\Groups\User;
use LaravelEnso\ControlPanelApi\App\Services\Groups\Version;

class Statistics
{
    private array $stats = [
        Status::class,
        Server::class,
        User::class,
        Version::class,
        Login::class,
        Job::class,
        Extra::class,
    ];

    public function register($registers)
    {
        $this->stats = [
            ...$this->stats,
            ...$registers,
        ];
    }

    public function all()
    {
        return (new Collection($this->stats))
            ->map(fn ($group) => App::make($group));
    }
}
