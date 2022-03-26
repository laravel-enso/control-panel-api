<?php

namespace LaravelEnso\ControlPanelApi\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LaravelEnso\People\Models\Person;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Roles\Models\Role;
use LaravelEnso\UserGroups\Models\UserGroup;
use LaravelEnso\Users\Models\User;

class ApiUserSeeder extends Seeder
{
    private const email = 'monitoring@laravel-enso.com';
    private UserGroup $group;
    private Person $person;

    public function run()
    {
        DB::transaction(fn () => $this->user());
    }

    public function user(): void
    {
        User::factory()->create([
            'person_id' => $this->person()->id,
            'group_id' => $this->group()->id,
            'email' => $this->person()->email,
            'password' => '!',
            'role_id' => $this->role()->id,
            'is_active' => true,
        ]);
    }

    public function group(): UserGroup
    {
        return $this->group ??= UserGroup::create([
            'name' => 'APIs',
            'description' => 'APIs user group',
        ]);
    }

    private function person()
    {
        return $this->person ??= Person::factory()->create([
            'name' => 'Monitoring',
            'appellative' => 'Monitoring',
            'email' => self::email,
            'birthday' => '1924-12-24',
            'phone' => '+40793232522',
        ]);
    }

    private function role()
    {
        $role = Role::factory()->create([
            'menu_id' => null,
            'name' => 'monitoring',
            'display_name' => 'monitoring',
            'description' => 'Monitoring role.',
        ]);

        $permissions = Permission::where('name', 'like', 'apis.%')->pluck('id');
        $role->syncPermissions($permissions->toArray());
        $role->userGroups()->sync([$this->group()->id]);

        return $role;
    }
}
