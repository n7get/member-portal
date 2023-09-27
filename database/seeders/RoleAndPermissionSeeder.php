<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'access-resources']);
        Permission::create(['name' => 'manage-activities']);
        Permission::create(['name' => 'manage-members']);
        Permission::create(['name' => 'manage-resources']);
        Permission::create(['name' => 'manage-users']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'manage-users',
        ]);
        
        $loadershipRole = Role::create(['name' => 'leadership']);
        $loadershipRole->givePermissionTo([
            'manage-members',
        ]);

        $activitiesRole = Role::create(['name' => 'activities']);
        $activitiesRole->givePermissionTo([
            'manage-activities',
        ]);

        $resourcesRole = Role::create(['name' => 'resources']);
        $resourcesRole->givePermissionTo([
            'manage-resources',
        ]);

        $memberRole = Role::create(['name' => 'member']);
        $memberRole->givePermissionTo([
            'access-resources',
        ]);

        $admin = User::first();
        $admin->assignRole('admin');
        $admin->assignRole('activities');
        $admin->assignRole('leadership');
        $admin->assignRole('resources');
        $admin->assignRole('member');
    }
}
