<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class MysqlVersion extends BaseSensor
{
    public function value()
    {
        return DB::select('select version() as version')[0]->version;
    }
}
