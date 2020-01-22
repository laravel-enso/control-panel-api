<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class PhpVersion extends BaseSensor
{
    public function value()
    {
        return PHP_VERSION;
    }
}
