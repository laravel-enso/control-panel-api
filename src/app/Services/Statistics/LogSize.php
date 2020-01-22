<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\File;
use LaravelEnso\Helpers\App\Classes\Decimals;

class LogSize extends BaseSensor
{
    public function value()
    {
        $size = File::size(storage_path('logs/laravel.log'));

        return Decimals::div($size, 1024 * 1024);
    }
}
