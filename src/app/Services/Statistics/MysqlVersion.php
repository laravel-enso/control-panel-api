<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class MysqlVersion extends BaseStatistics
{
    public function handle()
    {
        return DB::select('select version() as version')[0]->version;
    }
}
