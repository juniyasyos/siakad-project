<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        Roles::create([
            'name' => 'admin',
            'description' => 'Administrator with full access.'
        ]);

        Roles::create([
            'name' => 'teacher',
            'description' => 'Teacher role with access to teaching resources.'
        ]);

        Roles::create([
            'name' => 'parent',
            'description' => 'Parent role with access to student-related information.'
        ]);
    }
}
