<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ControlPanelApi\App\Facades\Actions;
use LaravelEnso\ControlPanelApi\App\Facades\Statistics;

class ControlPanelServiceProvider extends ServiceProvider
{
    protected array $stats = [];
    protected array $actions = [];

    public function boot()
    {
        Statistics::register($this->stats);
        Actions::register($this->actions);
    }
}
