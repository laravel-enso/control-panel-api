<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

class OperatingSystem extends Sensor
{
    public function value()
    {
        return PHP_OS === 'Linux'
            ? $this->version()
            : 'N/A';
    }

    public function tooltip(): string
    {
        return 'operating system';
    }

    public function icon(): array
    {
        return ['fab', 'ubuntu'];
    }

    public function order(): int
    {
        return 400;
    }

    private function version()
    {
        $output = shell_exec('lsb_release -a | grep Description');

        $line = explode(':', $output);

        return trim($line[1]);
    }
}
