<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-hospital', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-hospital', 'guard_name' => 'admin']);
        Permission::create(['name' => 'index-hospitals', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-hospital', 'guard_name' => 'admin']);

        Permission::create(['name' => 'create-major', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-major', 'guard_name' => 'admin']);
        Permission::create(['name' => 'index-majors', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-major', 'guard_name' => 'admin']);

        Permission::create(['name' => 'create-doctor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-doctor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'index-doctors', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-doctor', 'guard_name' => 'admin']);

        Permission::create(['name' => 'create-offer', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-offer', 'guard_name' => 'admin']);
        Permission::create(['name' => 'index-offers', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-offer', 'guard_name' => 'admin']);

        Permission::create(['name' => 'create-admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'index-admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'create-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'index-roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'create-permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'index-permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-permission', 'guard_name' => 'admin']);


    }
}
