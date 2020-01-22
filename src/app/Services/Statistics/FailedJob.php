<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class FailedJob extends BaseSensor
{
    public function value()
    {
        return $this->filter(
            DB::table('failed_jobs')->selectRaw('id'), 'failed_at'
        )->count();
    }
}
