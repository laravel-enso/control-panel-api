<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ControlPanelApi\Facades\Actions;
use LaravelEnso\ControlPanelApi\Facades\Statistics;

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
