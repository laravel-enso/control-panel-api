<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

class Version extends BaseSensor
{
    public function value()
    {
        return config('enso.config.version');
    }

    public function description(): string
    {
        return 'version of application';
    }

    public function icon()
    {
        return ['fab', 'enso'];
    }
}
