<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\Helpers\App\Classes\Decimals;

class Load extends BaseSensor
{
    public function value()
    {
        return "{$this->load()} %";
    }

    public function tooltip(): string
    {
        return 'server load';
    }

    public function description(): ?string
    {
        return 'load of server (load / cpu count * 100)';
    }

    public function icon()
    {
        return ['fad', 'microchip'];
    }

    public function order(): int
    {
        return 100;
    }

    private function load()
    {
        $div = Decimals::div(sys_getloadavg()[0], $this->cpus() ?? 1);

        return Decimals::mul($div, 100, 0);
    }

    private function cpus()
    {
        switch (PHP_OS) {
            case 'Linux':
                return (int) shell_exec('cat /proc/cpuinfo | grep processor | wc -l');
            case 'Darwin':
                return (int) shell_exec('sysctl -n hw.ncpu');
        }
    }
}
