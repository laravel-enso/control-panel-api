<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Facades\DB;

class MysqlVersion extends Sensor
{
    public function value()
    {
        return DB::select('select version() as version')[0]->version;
    }

    public function tooltip(): string
    {
        return 'mysql version';
    }

    public function icon(): array
    {
        return ['fad', 'database'];
    }

    public function order(): int
    {
        return 300;
    }
}
