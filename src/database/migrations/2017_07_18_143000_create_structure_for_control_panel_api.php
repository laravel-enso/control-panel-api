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

    protected $menu = [
        'name' => 'Control Panel Api', 'icon' => 'fa fa-fw fa fa-fw fa-stethoscope', 'link' => 'system/controlPanelApi', 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
