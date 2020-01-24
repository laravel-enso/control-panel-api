<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\ControlPanelApi\App\Services\Actions\ClearLog;
use LaravelEnso\ControlPanelApi\App\Services\Actions\DownloadLog;
use LaravelEnso\ControlPanelApi\App\Services\Actions\Maintenance;

class Actions
{
    private array $actions = [
        'clearLog' => ClearLog::class,
        'downloadLog' => DownloadLog::class,
        'maintenance' => Maintenance::class,
    ];

    public function register($registers)
    {
        $this->actions = array_merge($this->actions, $registers);
    }

    public function all()
    {
        return (new Collection($this->actions))
            ->map(fn ($action) => new $action());
    }

    public function get($action)
    {
        return App::make($this->actions[$action]);
    }
}
