<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Facades\App;
use Laravel\Horizon\Contracts\JobRepository;

class PendingJobs extends Sensor
{
    public function value()
    {
        return App::make(JobRepository::class)->getRecent()
            ->filter(fn ($job) => $job->status === 'pending')
            ->count();
    }

    public function tooltip(): string
    {
        return 'pending jobs';
    }

    public function icon(): array
    {
        return ['fad', 'hourglass-half'];
    }

    public function order(): int
    {
        return 100;
    }
}
