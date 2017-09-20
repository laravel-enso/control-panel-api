<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForControlPanelApi extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.controlPanelApi', 'description' => 'Contact panel api group',
    ];

    protected $permissions = [
        ['name' => 'system.controlPanelApi.index', 'description' => 'Contact panel api index', 'type' => 0, 'default' => false],
    ];
}
