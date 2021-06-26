<?php

namespace LaravelEnso\ControlPanelApi\Services\Helpers;

use LaravelEnso\Helpers\Services\Decimals;

class Cpu
{
    public static function count(): int
    {
        return max(self::cpus(), 1);
    }

    public static function load(): string
    {
        $avg = Decimals::div(sys_getloadavg()[0], self::count());

        return Decimals::mul($avg, 100, 0);
    }

    private static function cpus()
    {
        return match (PHP_OS) {
            'Linux' => (int) shell_exec('cat /proc/cpuinfo | grep processor | wc -l'),
            'Darwin' => (int) shell_exec('sysctl -n hw.ncpu'),
        };
    }
}
