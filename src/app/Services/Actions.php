<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\ControlPanelApi\App\Contracts\Action;
use LaravelEnso\ControlPanelApi\App\Services\Actions\ClearLog;
use LaravelEnso\ControlPanelApi\App\Services\Actions\DownloadLog;
use LaravelEnso\ControlPanelApi\App\Services\Actions\Maintenance;

class Actions
{
    private array $actions = [
        ClearLog::class,
        DownloadLog::class,
        Maintenance::class,
    ];

    public function register($registers)
    {
        $this->actions = array_merge($this->actions, $registers);
    }

    public function all()
    {
        return (new Collection($this->actions))
            ->map(fn ($action) => App::make($action));
    }

    public function get($id)
    {
        return $this->all()
            ->first(fn (Action $action) => $action->id() === $id);
    }
}
