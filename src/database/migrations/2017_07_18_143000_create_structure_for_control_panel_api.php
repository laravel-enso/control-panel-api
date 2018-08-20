<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForControlPanelApi extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.controlPanelApi', 'description' => 'Control panel api permissions group',
    ];

    protected $permissions = [
        ['name' => 'system.controlPanelApi.index', 'description' => 'Control panel api index', 'type' => 0, 'is_default' => false],
    ];
}
