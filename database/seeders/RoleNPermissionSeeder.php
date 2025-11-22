<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleNPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles with API guard
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'api',
        ]);

        $developer = Role::firstOrCreate([
            'name' => 'developer',
            'guard_name' => 'api',
        ]);

        // Create permissions with API guard
        $permissions = [
            'create project',
            'edit project',
            'delete project',
            'create task',
            'edit task',
            'change task status',
            'delete task',
            'complete sprint',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api',
            ]);
        }

        // Assign permissions to roles
        $admin->givePermissionTo($permissions);
        $developer->givePermissionTo([
            'create task',
            'edit task',
            'change task status',
        ]);

        // Assign developer role to all users
        User::all()->each(function ($user) {
            if (!$user->hasRole('developer')) {
                $user->assignRole('developer');
            }
        });
    }
}
