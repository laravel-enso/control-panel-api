<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Collection;
use LaravelEnso\Helpers\App\Classes\Decimals;
use LaravelEnso\Helpers\App\Classes\DiskSize;

class Memory extends Sensor
{
    private Collection $memory;

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
        $div = Decimals::div($this->memory()->last(), $this->memory()->first());

        return (int) Decimals::mul($div, 100);
    }

    private function total()
    {
        return DiskSize::forHumans($this->memory()->first());
    }

    private function memory(): Collection
    {
        if (isset($this->memory)) {
            return $this->memory;
        }

        $memory = (string) trim(shell_exec('free | grep Mem'));

        $this->memory = (new Collection(explode(' ', $memory)))
            ->filter()
            ->values()
            ->splice(1, 2);

        return $this->memory;
    }
}
