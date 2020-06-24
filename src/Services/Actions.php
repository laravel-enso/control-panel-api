<?php

namespace LaravelEnso\ControlPanelApi\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\ControlPanelApi\Services\Actions\ClearLog;
use LaravelEnso\ControlPanelApi\Services\Actions\DownloadLog;
use LaravelEnso\ControlPanelApi\Services\Actions\Maintenance;
use LaravelEnso\ControlPanelCommon\Contracts\Action;

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
