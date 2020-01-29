<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class PhpVersion extends BaseSensor
{
    public function value()
    {
        return PHP_VERSION;
    }

    public function tooltip(): string
    {
        return 'php version';
    }

    public function icon()
    {
        return ['fab', 'php'];
    }
}
