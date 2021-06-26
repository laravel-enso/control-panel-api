<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Facades\DB;

class MysqlVersion extends Sensor
{
    public function value(): mixed
    {
        [$version] = explode('-', $this->dbVersion());

        return $version;
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

    private function dbVersion(): string
    {
        return DB::select('select version() as version')[0]->version;
    }
}
