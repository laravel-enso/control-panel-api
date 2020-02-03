<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Collection;
use LaravelEnso\Helpers\App\Classes\Decimals;
use LaravelEnso\Helpers\App\Classes\DiskSize;

class Memory extends Sensor
{
    private array $memory;

    public function value()
    {
        return PHP_OS === 'Linux'
            ? "{$this->usage()} %"
            : 'N/A';
    }

    public function tooltip(): string
    {
        return PHP_OS === 'Linux'
            ? "memory usage from a total of {$this->total()}"
            : 'N/A';
    }

    public function icon(): array
    {
        return ['fad', 'memory'];
    }

    public function order(): int
    {
        return 200;
    }

    private function usage()
    {
        $div = Decimals::div($this->memory()[2], $this->memory()[1]);

        return (int) Decimals::mul($div, 100);
    }

    private function total()
    {
        return DiskSize::forHumans($this->memory()[1]);
    }

    private function memory()
    {
        if (isset($this->memory)) {
            return $this->memory;
        }

        $free = (string) trim(shell_exec('free'));

        $this->memory = (new Collection(explode(' ', explode(PHP_EOL, $free)[1])))
            ->filter()
            ->values()
            ->toArray();

        return $this->memory;
    }
}
