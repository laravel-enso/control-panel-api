<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Collection;
use LaravelEnso\Helpers\App\Classes\Decimals;

class Memory extends BaseSensor
{
    public function value()
    {
        if (PHP_OS === 'Linux') {
            $free = (string) trim(shell_exec('free'));
            $mem = (new Collection(explode(' ', explode(PHP_EOL, $free)[1])))
                ->filter()
                ->values();

            return Decimals::mul(Decimals::div($mem[2], $mem[1]), 100, 0);
        }

        return 0;
    }
}
