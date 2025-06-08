<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create Admin User
        User::create([
            'name' => 'Admin SMP Muhammadiyah Watukelir',
            'email' => 'adminsmpmuhkelir@gmail.com',
            'role_id' => $adminRole->id,
            'password' => Hash::make('admin123'),
        ]);

        // Create Regular User for testing
        User::create([
            'name' => 'User Test',
            'email' => 'user@smpmuhkelir.com',
            'role_id' => $userRole->id,
            'password' => Hash::make('user123'),
        ]);
    }
}
