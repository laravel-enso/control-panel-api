<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\App;
use Laravel\Horizon\Contracts\JobRepository;

class Job extends BaseSensor
{
    public function value()
    {
        return App::make(JobRepository::class)->getRecent()
            ->filter(fn ($job) => $job->status === 'pending')
            ->count();
    }
}
