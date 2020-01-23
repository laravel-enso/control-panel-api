<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Helpers\App\Classes\Decimals;

class Load extends BaseSensor
{
    public function value()
    {
        return Decimals::mul(
            Decimals::div(sys_getloadavg()[0], $this->cpus()), 100
        );
    }

    private function cpus()
    {
        switch (PHP_OS) {
            case 'Linux':
                return (int) shell_exec('cat /proc/cpuinfo | grep processor | wc -l');
            case 'Darwin':
                return (int) shell_exec('sysctl -n hw.ncpu');
            default:
                return 1;
        }
    }
}
