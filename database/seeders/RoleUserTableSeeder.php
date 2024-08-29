<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        // Attach roles to users
        $admin = User::where('email', 'admin@example.com')->first();
        $teacher = User::where('email', 'teacher@example.com')->first();
        $parent = User::where('email', 'parent@example.com')->first();

        $adminRole = Roles::where('name', 'admin')->first();
        $teacherRole = Roles::where('name', 'teacher')->first();
        $parentRole = Roles::where('name', 'parent')->first();

        // Attach roles if not already attached
        $this->attachRole($admin, $adminRole);
        $this->attachRole($teacher, $teacherRole);
        $this->attachRole($parent, $parentRole);
    }

    /**
     * Attach a role to a user if not already attached.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Roles $role
     * @return void
     */
    protected function attachRole($user, $role)
    {
        // Check if the role is already attached
        if (!$user->roles->contains($role->id)) {
            $user->roles()->attach($role->id);
        }
    }
}
