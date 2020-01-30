<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class FailedJob extends BaseSensor
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

    public function description(): ?string
    {
        return 'number of failed jobs';
    }

    public function icon()
    {
        return ['fad', 'exclamation-circle'];
    }

    public function order(): int
    {
        return 200;
    }
}
