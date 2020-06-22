<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Actions;

use LaravelEnso\ControlPanelCommon\App\Contracts\Action;

class DownloadLog implements Action
{
    public function id()
    {
        return 'downloadLog';
    }

    public function handle()
    {
        return [
            'url' => url()->temporarySignedRoute(
                'api.controlPanelApi.action.downloadLog',
                now()->addSeconds(60)
            ),
        ];
    }

    public function label(): string
    {
        return 'Log';
    }

    public function tooltip(): string
    {
        return "this actions downloads the applications's log";
    }

    public function icon(): array
    {
        return ['fad', 'download'];
    }

    public function confirmation(): bool
    {
        return false;
    }

    public function order(): int
    {
        return 200;
    }
}
