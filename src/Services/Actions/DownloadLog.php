<?php

namespace LaravelEnso\ControlPanelApi\Services\Actions;

use Carbon\Carbon;
use LaravelEnso\ControlPanelCommon\Contracts\Action;
use LaravelEnso\ControlPanelCommon\Services\IdProvider;

class DownloadLog extends IdProvider implements Action
{
    public function handle(): array
    {
        return [
            'url' => url()->temporarySignedRoute(
                'apis.controlPanel.action.downloadLog',
                Carbon::now()->addSeconds(60)
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
