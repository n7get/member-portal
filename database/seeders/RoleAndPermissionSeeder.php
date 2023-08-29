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
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-members']);
        Permission::create(['name' => 'manage-resources']);
        Permission::create(['name' => 'access-resources']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'manage-users',
        ]);
        
        $loadershipRole = Role::create(['name' => 'leadership']);
        $loadershipRole->givePermissionTo([
            'manage-members',
            'manage-resources',
        ]);

        $memberRole = Role::create(['name' => 'member']);
        $memberRole->givePermissionTo([
            'access-resources',
        ]);

        $admin = User::first();
        $admin->assignRole('admin');
        $admin->assignRole('leadership');
        $admin->assignRole('member');
    }
}
