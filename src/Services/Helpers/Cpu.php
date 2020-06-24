<?php

namespace LaravelEnso\ControlPanelApi\Services\Helpers;

use LaravelEnso\Helpers\Services\Decimals;

class Cpu
{
    public static function count()
    {
        return max(self::cpus(), 1);
    }

    public static function load()
    {
        $avg = Decimals::div(sys_getloadavg()[0], self::count());

        return Decimals::mul($avg, 100, 0);
    }

    private static function cpus()
    {
        switch (PHP_OS) {
            case 'Linux':
                return (int) shell_exec('cat /proc/cpuinfo | grep processor | wc -l');
            case 'Darwin':
                return (int) shell_exec('sysctl -n hw.ncpu');
        }
    }
}
