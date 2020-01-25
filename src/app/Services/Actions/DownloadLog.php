<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Actions;

use LaravelEnso\ControlPanelApi\App\Contracts\Action;

class DownloadLog implements Action
{
    public function handle()
    {
        return [
            'url' => url()->temporarySignedRoute(
                'api.controlPanelApi.downloadLog',
                now()->addSeconds(60)
            ),
        ];
    }

    public function label(): string
    {
        return 'Download Log';
    }

    public function description(): string
    {
        return 'download log';
    }

    public function icon()
    {
        return 'download';
    }

    public function confirmation(): bool
    {
        return false;
    }
}
