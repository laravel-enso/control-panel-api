<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\Config;

class Version extends BaseSensor
{
    public function value()
    {
        return Config::get('enso.config.version');
    }

    public function tooltip(): string
    {
        return 'app version';
    }

    public function icon()
    {
        return ['fab', 'enso'];
    }
}
