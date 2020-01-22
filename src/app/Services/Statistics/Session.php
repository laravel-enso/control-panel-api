<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class Session extends BaseStatistics
{
    public function handle()
    {
        return DB::table('sessions')
            ->selectRaw('user_id')
            ->count();
    }
}
