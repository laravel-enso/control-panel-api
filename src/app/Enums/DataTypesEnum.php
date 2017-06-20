<?php
/**
 * Created by PhpStorm.
 * User: mihai
 * Date: 27.07.2016
 * Time: 9:19.
 */

namespace LaravelEnso\ControlPanelApi\app\Enums;

use LaravelEnso\Helpers\Classes\AbstractEnum;

class DataTypesEnum extends AbstractEnum
{

    public function __construct()
    {

        $this->data = [
            'loginsCount'         => 'logins',
            'actionsCount'        => 'actions',
            'failedJobsCount'     => 'failed jobs',
            'activeSessionsCount' => 'active sessions',
            'serverTime'          => 'server time',
            'logFileSize'             => 'log size',
        ];
    }

    public function getJsonKVData()
    {

        $tmp = [];
        foreach ($this->data as $key => $value) {
            $tmp[] = [
                'key'   => $key,
                'value' => __($value),
            ];
        }

        return json_encode($tmp);
    }
}
