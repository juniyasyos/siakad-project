<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Roles::where('name', 'admin')->first();
        $teacherRole = Roles::where('name', 'teacher')->first();
        $parentRole = Roles::where('name', 'parent')->first();

        // Create users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'profile_image' => 'https://via.placeholder.com/150',
            'is_active' => true,
            'is_admin' => true,
            'last_login_at' => now(),
            'failed_login_attempts' => 0,
        ]);

        $teacher = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => bcrypt('password'),
            'profile_image' => 'https://via.placeholder.com/150',
            'is_active' => true,
            'is_admin' => false,
            'last_login_at' => now(),
            'failed_login_attempts' => 0,
        ]);

        $parent = User::create([
            'name' => 'Parent User',
            'email' => 'parent@example.com',
            'password' => bcrypt('password'),
            'profile_image' => 'https://via.placeholder.com/150',
            'is_active' => true,
            'is_admin' => false,
            'last_login_at' => now(),
            'failed_login_attempts' => 0,
        ]);

        // Attach roles to users
        $admin->roles()->attach($adminRole);
        $teacher->roles()->attach($teacherRole);
        $parent->roles()->attach($parentRole);
    }
}

