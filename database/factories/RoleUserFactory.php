<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'role_id' => Roles::factory(),
        ];
    }
}
