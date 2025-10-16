<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'create-users',
            'edit-users',
            'delete-users',
            'create-appointment',
            'edit-appointment',
            'delete-appointment',
            'create-doctor',
            'edit-doctor',
            'delete-doctor',
            'create-hospital',
            'edit-hospital',
            'delete-hospital',
            'create-patient',
            'edit-patient',
            'delete-patient',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Assign permissions to Admin role
        $adminRole->givePermissionTo($permissions);

        // Assign limited permissions to User role
        $userRole->givePermissionTo([
            'create-appointment',
        ]);

        // Create users
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $user = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
        ]);

        // Assign roles to users
        $admin->assignRole('Admin');
        $user->assignRole('user');
    }
}
