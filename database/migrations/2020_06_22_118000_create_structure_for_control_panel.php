<?php

use LaravelEnso\Migrator\Database\Migration;

class CreateStructureForControlPanel extends Migration
{
    protected array $permissions = [
        ['name' => 'api.controlPanelApi.statistics', 'description' => 'Get statistics', 'is_default' => false],
        ['name' => 'api.controlPanelApi.actions', 'description' => 'Get available Actions', 'is_default' => false],
        ['name' => 'api.controlPanelApi.action', 'description' => 'Do an action', 'is_default' => false],
    ];
}
