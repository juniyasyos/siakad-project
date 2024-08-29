<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Use bcrypt to hash password
            'profile_image' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean(),
            'is_admin' => $this->faker->boolean(),
            'last_login_at' => $this->faker->dateTimeThisYear(),
            'failed_login_attempts' => $this->faker->numberBetween(0, 5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withRoles($roles = [])
    {
        return $this->afterCreating(function (User $user) use ($roles) {
            if (empty($roles)) {
                $roles = Roles::pluck('id')->toArray();
            }

            $user->roles()->attach($roles);
        });
    }
}
