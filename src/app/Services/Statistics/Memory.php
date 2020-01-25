<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Collection;
use LaravelEnso\Helpers\App\Classes\Decimals;

class Memory extends BaseSensor
{
    public function value()
    {
        if (PHP_OS === 'Linux') {
            return "{$this->memoryUsage()} %";
        }

        return '-';
    }

    public function description(): string
    {
        return 'memory usage';
    }

    public function icon()
    {
        return 'memory';
    }

    private function memoryUsage()
    {
        $free = (string) trim(shell_exec('free'));
        $mem = (new Collection(explode(' ', explode(PHP_EOL, $free)[1])))
            ->filter()
            ->values();

        return Decimals::mul(
            Decimals::div($mem[2], $mem[1]), 100, 0
        );
    }
}
