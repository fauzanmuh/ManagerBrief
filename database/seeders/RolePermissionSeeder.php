<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::create(['name' => 'manage data user']);
        Permission::create(['name' => 'manage developer']);
        Permission::create(['name' => 'manage tasks']);
        Permission::create(['name' => 'manage modules']);
        Permission::create(['name' => 'manage projects']);
        Permission::create(['name' => 'manage task types']);
        Permission::create(['name' => 'update task status']);
        Permission::create(['name' => 'manage reports']);

        // Roles
        $manager = Role::create(['name' => 'manager']);
        $developer = Role::create(['name' => 'developer']);

        // Assign permissions to roles
        $manager->givePermissionTo(['manage data user', 'manage developer', 'manage tasks', 'manage modules', 'manage projects', 'manage task types']);
        $developer->givePermissionTo(['manage reports']);
    }
}
