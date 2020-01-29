<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ControlPanelApi\App\Facades\Actions;
use LaravelEnso\ControlPanelApi\App\Facades\Statistics;

abstract class ControlPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Statistics::register($this->stats());
        Actions::register($this->actions());
    }

    abstract protected function stats(): array;

    abstract protected function actions(): array;
}
