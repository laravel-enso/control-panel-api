<?php

namespace LaravelEnso\ControlPanelApi\app\Services;

use LaravelEnso\ControlPanelApi\app\Enums\DataTypes;
use LaravelEnso\Helpers\app\Classes\Obj;

class Request
{
    public static function isValid(Obj $params)
    {
        return collect($params->get('dataTypes'))
            ->diff(DataTypes::keys())
            ->isEmpty();
    }
}
