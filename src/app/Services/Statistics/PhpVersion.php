<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class PhpVersion extends BaseSensor
{
    public function value()
    {
        return PHP_VERSION;
    }

    public function description(): string
    {
        return 'version of php';
    }

    public function icon()
    {
        return ['fab', 'php'];
    }
}
