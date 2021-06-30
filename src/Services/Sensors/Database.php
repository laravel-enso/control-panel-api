<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Database extends Sensor
{
    private string $version;

    public function value(): mixed
    {
        [$version] = explode('(', $this->version());

        if ($this->isPostgreSQL()) {
            [, $version] = explode(' ', $version);
        }

        return $version;
    }

    public function tooltip(): string
    {
        $database = $this->isPostgreSQL() ? 'PostgreSQL' : 'MySQL';

        return "{$database} version";
    }

    public function icon(): array
    {
        return ['fad', 'database'];
    }

    public function order(): int
    {
        return 300;
    }

    private function isPostgreSQL(): bool
    {
        return Str::startsWith($this->version(), 'PostgreSQL');
    }

    private function version(): string
    {
        return $this->version
            ??= DB::select('select version() as version')[0]->version;
    }
}
