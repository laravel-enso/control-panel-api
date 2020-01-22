<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\ControlPanelApi\App\Commands\Monitor;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->command()
            ->loadRoutesFrom(__DIR__.'/routes/api.php');
    }

    private function command(): self
    {
        $this->commands(Monitor::class);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('enso:control-panel-api:monitor')->everyMinute();
        });

        return $this;
    }
}
