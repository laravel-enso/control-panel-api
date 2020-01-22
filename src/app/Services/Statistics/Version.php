<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class Version extends BaseSensor
{
    public function value()
    {
        return config('enso.config.version');
    }
}
