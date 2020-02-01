<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Collection;
use LaravelEnso\Helpers\App\Classes\Decimals;

class Memory extends Sensor
{
    public function value()
    {
        if (PHP_OS === 'Linux') {
            return "{$this->memoryUsage()} %";
        }

        return 'N/A';
    }

    public function tooltip(): string
    {
        return 'memory usage';
    }

    public function icon(): array
    {
        return ['fad', 'memory'];
    }

    public function order(): int
    {
        return 200;
    }

    private function memoryUsage()
    {
        $free = (string) trim(shell_exec('free'));

        $mem = (new Collection(explode(' ', explode(PHP_EOL, $free)[1])))
            ->filter()
            ->values();

        return (int) Decimals::mul(Decimals::div($mem[2], $mem[1]), 100);
    }
}
