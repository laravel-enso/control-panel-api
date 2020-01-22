<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\App;
use Laravel\Horizon\Contracts\JobRepository;

class Job extends BaseStatistics
{
    public function handle()
    {
        return App::make(JobRepository::class)->getRecent()
            ->filter(fn ($job) => $job->status === 'pending')
            ->count();
    }
}
