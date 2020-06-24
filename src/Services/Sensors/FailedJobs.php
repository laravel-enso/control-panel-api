<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Facades\DB;

class FailedJobs extends Sensor
{
    public function value()
    {
        return $this->filter(
            DB::table('failed_jobs')->selectRaw('id'),
            'failed_at'
        )->count();
    }

    public function tooltip(): string
    {
        return 'failed jobs';
    }

    public function icon(): array
    {
        return ['fad', 'exclamation-circle'];
    }

    public function order(): int
    {
        return 200;
    }
}
