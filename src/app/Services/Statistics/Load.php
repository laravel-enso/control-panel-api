<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Helpers\App\Classes\Decimals;

class Load extends BaseStatistics
{
    public function handle()
    {
        return Decimals::mul(
            Decimals::div(sys_getloadavg()[0], $this->cpues()), 100
        );
    }

    private function cpues()
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
