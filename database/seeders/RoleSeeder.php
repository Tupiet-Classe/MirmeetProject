<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $moderator = Role::create(['name' => 'moderator']);
        $client = Role::create(['name' => 'client']);

        Permission::create(['name' => 'dashboard.view'])->syncRoles([$admin, $moderator]);
        Permission::create(['name' => 'dashboard.validate.users'])->syncRoles([$admin, $moderator]);
        Permission::create(['name' => 'dashboard.validate.users.restore'])->syncRoles([$admin]);
        Permission::create(['name' => 'dashboard.manage.users'])->syncRoles([$admin, $moderator]);
        Permission::create(['name' => 'dashboard.verify.users'])->assignRole([$admin]);
        Permission::create(['name' => 'wall.main.users'])->assignRole($client);
        Permission::create(['name' => 'wall.discover.users'])->assignRole($client);

    }
}
